

class Notification
{
    constructor(user) {
        this.user = user;

        this.init();
        this.register()
    }

    init() {
        this.elmCounter = $('.notification-count');
        this.elmCounterWrapper = $('.notification-count-wrapper');
        this.elmNotificationsList = $('#unreadNotificationList');
    }

    register() {
        window
            .Echo
            .private('App.User.' + this.user.id)
            .notification(notification => {
                let nothingText = document.getElementById('nothingNewNotification');
                if (nothingText) {
                    nothingText.innerText = '';
                }
                this.setCount(notification.unreadCount + 1);
                let listItemTemplate = ' <li class="noti-list__item"> <a href="' + notification.action_url + '"> <div class="noti-list__icon ';

                if (notification.gametype) {
                    listItemTemplate += 'noti-list__icon--img"> <img src="{{ image_url }}" alt="League of Legends Logo" />';
                } else {
                    let initial = notification.user.initial;
                    listItemTemplate += '"><div class="user-letter ' + initial + '">' + initial + '</div>';
                }

                listItemTemplate += '</div> <div class="noti-list__info"> <div class="noti-list__text">{{ message }}</div><div class="noti-list__date">{{ timestamp }}</div></div></a></li>'

                listItemTemplate = listItemTemplate.replace('{{ message }}', notification.message);
                listItemTemplate = listItemTemplate.replace('{{ timestamp }}', notification.timeFromNow)
                listItemTemplate = listItemTemplate.replace('{{ image_url }}', '/img/icons/' + notification.gametype + '.svg');

                this.elmNotificationsList.prepend(listItemTemplate)

                this.triggerSound(notification);
            })

    }

    triggerSound(notification) {
        if (! window.App.user.allow_notification_sound) {
            return;
        }

        switch(notification.type) {
            case 'App\\Notifications\\NewChatMessageNotification':
                this.addSoundElementAndPlay('/sound/new-message.mp3');
                break;
            default:
                this.addSoundElementAndPlay('/sound/new-notification.mp3');
                break;
        }
    }

    addSoundElementAndPlay(filename) {
        let mp3Source = '<source src="' + filename + '" type="audio/mp3">';
        document.getElementById("sound").innerHTML='<audio id="notification-sound" autoplay="autoplay">' + mp3Source + '</audio>';
        document.getElementById('notification-sound').play();
    }

    setCount(count) {
        if (count <= 0) {
            this.elmCounterWrapper.hide();
            return;
        }
        let elm = '<div class="noti-header__counter counter"><div class="number notification-count">'+count+'</div></div>';
        this.elmCounterWrapper.html('');
        this.elmCounterWrapper.html(elm);
        this.elmCounterWrapper.show();
        this.elmCounter.text(count)
    }
}


window.notification = new Notification(window.App.user);
