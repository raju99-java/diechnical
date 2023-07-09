<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cms;
use Modules\Admin\Http\Requests\CmsRequest;
use Yajra\Datatables\Datatables;
use Validator;

class CmsController extends AdminController {
    public function index(Request $request) {
        return view('admin::cms.index');
    }

    public function get_list() {
        $data = Cms::get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->editColumn('type', function($row) {
                                return ($row->type === '1') ? "Text" : (($row->type === '2') ? "Image" : "Video");
                            })
                            ->editColumn('updated_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->updated_at));
                            })
                            ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route('cms-edit', ['id' => base64_encode($model->id)]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                        })
                            ->rawColumns(['action'])
                            ->make(true);
    }

    

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $id = base64_decode($id);
        $model = Cms::findOrFail($id);
        return view('admin::cms.view', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function get_edit($id) {
        $id = base64_decode($id);
        $model = Cms::findOrFail($id);
        return view('admin::cms.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function post_edit(CmsRequest $request, $id) {
        $input = $request->except('content_body');
        $id = base64_decode($id);
        $model = Cms::findOrFail($id);
        if ($model->type === '2') {
            if ($request->file('content_body')) {
                $img_name = $this->rand_string(20) . '.' . $request->file('content_body')->getClientOriginalExtension();
                $file = $request->file('content_body');
                $file->move(public_path('uploads/frontend/cms/pictures/'), $img_name);
//                Image::make($file)->resize(1140, 270)->save(public_path('uploads/frontend/cms/pictures/') . $img_name);
                $input['content_body'] = $img_name;
            }
        } else if ($model->type === '3') {
            if ($request->file('content_body')) {
                $vdo_name = $this->rand_string(20) . '.' . $request->file('content_body')->getClientOriginalExtension();
                $file = $request->file('content_body');
                $file->move(public_path('uploads/frontend/cms/videos/'), $vdo_name);
                $input['content_body'] = $vdo_name;
            }
        } else {
            $input['content_body'] = $request->input('content_body');
        }
        $model->update($input);
        $request->session()->flash('success', 'Content updated successfully.');
        return redirect()->route('cms-edit', ['id' => base64_encode($id)])->with('success_msg', 'Content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
