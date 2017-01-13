<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function getFaqUpdateView($locale, $id)
    {
        App::setLocale($locale);
        $categories = $this->getCategories();

        if (isset($id)) {
            /* $article  = Article::with('faq.translation')->where('id', '=' , $id)->first();*/
            $faqs = FaqTranslation::where('faq_id', '=', $id)->get();

            return view('admin_faq', ['categories' => $categories, 'faqs' => $faqs]);
        } else {
            return view('admin_faq', ['categories' => $categories]);
        }

    }

    public function getFaqCreateView($locale, $id = null)
    {
        App::setLocale($locale);
        $categories = $this->getCategories();

        if (isset($id)) {
            /* $article  = Article::with('faq.translation')->where('id', '=' , $id)->first();*/
            $article = Article::with('translation')->find($id);

            return view('admin_faq', ['categories' => $categories, 'article' => $article]);
        } else {
            return view('admin_faq', ['categories' => $categories]);
        }

    }

    public function updateFaq(Request $request)
    {
        /*     dd($request);*/
        if (isset($request->faqtrans_id)) {
            foreach ($request->faqtrans_id as $key => $faqtrans_id) {
                $curr_faq = FaqTranslation::find($faqtrans_id);
                $curr_faq->question = $request->question[$key];
                $curr_faq->answer = $request->answer[$key];
                $curr_faq->save();
            }
        }
    }

    public function createFaq(Request $request)
    {
        /* dd($request);*/


        $faq = new Faq([]);
        $faq->save();

        $faqTrans_nl = new FaqTranslation([
            'question' => $request->question_nl,
            'answer' => $request->answer_nl,
            'locale' => 'nl',
            'faq_id' => $faq->id
        ]);
        $faqTrans_en = new FaqTranslation([
            'question' => $request->question_en,
            'answer' => $request->answer_en,
            'locale' => 'nl',
            'faq_id' => $faq->id
        ]);
        $faqTrans_en->save();
        $faqTrans_nl->save();

        if (isset($request->faq_art_id)) {
            $article_faq = new ArticlesFaq([
                'article_id' => $request->faq_art_id,
                'faq_id' => $faq->id
            ]);
            $article_faq->save();
        }
        return 'succes';
    }
}
