<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\HelpDeskFaqCategories;
use App\HelpDeskFaq;
use App\Http\Requests\SaveHelpDeskFaqRequest;

class HelpDeskFaqController extends Controller
{
    public function index()
    {
        $all_categories = $this->getAllCategoriesWithFaq();
        $all_questions = $this->getAllQuestions();
        $title = 'Help Desk';

        return view('panel.help-center.faq', [
            'all_categories' => $all_categories,
            'all_questions'  => $all_questions,
            'title' => $title,
        ]);
    }

    public function add()
    {
        $categories = $this->getAllCategoriesWithFaq();
        return view('panel.help-center.create', compact('categories'));
    }

    public function save(SaveHelpDeskFaqRequest $request)
    {
        $validatedFaqData = $request->validated();

        if (HelpDeskFaq::create($validatedFaqData)) {
            return back()->with('success', 'New FAQ has been added successfully.');
        }
        return back()->with('error', 'Something went wrong while adding new FAQ.');
    }

    public function delete($faq_id)
    {
        if (HelpDeskFaq::where(['id' => $faq_id])->delete()) {
            return back()->with('success', 'FAQ deleted successfully.');
        }
        return back()->with('error', 'Something went wrong while deleting FAQ.');
    }

    public function edit($faq_id)
    {
        $faq = $this->getSingleFaq($faq_id);
        $categories = $this->getAllCategoriesWithFaq();
        if (optional($faq)->count()) {
            return view('panel.help-center.edit', compact('faq', 'categories'));
        }
        return redirect('/panel/help')->with('error', 'FAQ not found that you trying to edit.');
    }

    public function update(SaveHelpDeskFaqRequest $request)
    {
        $validatedFaqData = $request->validated();
        $faq_id = $request->input('id');

        $validatedFaqData['labels'] = implode(',', $validatedFaqData['labels']);
        $status = HelpDeskFaq::where(['id' => $faq_id])->update($validatedFaqData);

        if ($status) {
            return back()->with('success', 'FAQ updated successfully.');
        }
        return back()->with('error', 'Something went wrong while updating FAQ.');
    }

    private function getAllCategoriesWithFaq()
    {
        return HelpDeskFaqCategories::get();
    }

    private function getAllQuestions()
    {
        return HelpDeskFaq::all();
    }

    private function getSingleFaq($faq_id)
    {
        return HelpDeskFaq::where(['id' => $faq_id])->first();
    }
}
