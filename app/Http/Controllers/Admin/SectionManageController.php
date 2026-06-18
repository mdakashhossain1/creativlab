<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ManageSection;
use App\Http\Controllers\Controller;

class SectionManageController extends Controller
{
    protected array $pageLabels = [
        'home_one'   => 'Digital Marketing',
        'home_two'   => 'Creative Content',
        'home_three' => 'Web Development',
        'home_four'  => 'SEO Optimization',
        'home_five'  => 'Ad Films',
        'home_six'   => 'WhatsApp API',
        'home_seven' => 'IT Business',
    ];

    public function index()
    {
        $pageTitle = __('Section Management');
        $pageName  = ManageSection::pluck('page_name')->unique()->toArray();
        $order = ['home_one', 'home_two', 'home_three', 'home_four', 'home_five', 'home_six', 'home_seven'];
        usort($pageName, function ($a, $b) use ($order) {
            return array_search($a, $order) <=> array_search($b, $order);
        });

        $pageLabels = $this->pageLabels;

        return view('admin.section.index', compact('pageTitle', 'pageName', 'pageLabels'));
    }

    public function edit($page)
    {
        $pagesections = ManageSection::where('page_name', $page)->orderBy('serial_number')->get();
        $pageLabel    = $this->pageLabels[$page] ?? ucwords(str_replace('_', ' ', $page));

        return view('admin.section.edit', compact('pagesections', 'pageLabel'));
    }

    public function update(Request $request){

        $ids=$request->id;
        $status=$request->status;
        $position=$request->position;

        foreach($ids as $key => $id){
            $manageSection=ManageSection::findOrFail($id);

            if($manageSection){
                $manageSection->status=$status[$key] ?? 0;
                $manageSection->serial_number=$position[$key];
                $manageSection->save();
            }

        }

        $notify_message = trans('Update successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->route('admin.section-manage')->with($notify_message);

    }
}
