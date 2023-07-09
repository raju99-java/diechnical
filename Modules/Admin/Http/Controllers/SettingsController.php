<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Http\Controllers\Admin\AdminController;
use App\Model\Settings;
use Session;

class SettingsController extends AdminController {

    public function index() {

        $data = array();
        $tab = 0;

        if (Session::has('tab')) {
            $data['tab'] = Session::get('tab');
            Session::forget('tab');
        } else {
            $data['tab'] = 0;
        }


        $modules = [];

        foreach (Settings::all() as $mod) {
            $modules[$mod->module][] = (object) array(
                        'slug' => $mod->slug,
                        'title' => $mod->title,
                        'description' => $mod->description,
                        'type' => $mod->type,
                        'default' => $mod->default,
                        'value' => $mod->value,
                        'options' => $mod->options,
                        'is_required' => $mod->is_required,
                        'is_gui' => $mod->is_gui,
                        'module' => $mod->module,
                        'order' => $mod->row_order,
            );
        }

        $data['modules'] = $modules;
        return view('admin::settings.index', $data);
    }

    public function store(Request $request) {
        $data = $request->all();
        $update_value = array();

        if ($request->hasFile('home_page_banner_img')) {
            $sample_image = $request->file('home_page_banner_img');
            $imagename = time() . rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
            $destinationPath = base_path('uploads/cms/');
            $sample_image->move($destinationPath, $imagename);
            Settings::where('slug', 'home_page_banner_img')
                    ->where('module', $data['save_module_settings'])
                    ->update(['value' => $imagename]);
        }


        foreach ($data['settings'] as $key => $val) {
            if (is_array($val)) {
                $val = implode("|", $val);
            }


            $update_value[] = array('slug' => $key, 'value' => $val);

            Settings::where('slug', $key)
                    ->where('module', $data['save_module_settings'])
                    ->update(['value' => $val]);
        }
        Session::put('tab', $data['tab']);
        return redirect()->route('settings')->with('success_msg', 'Settings updated successfully.');
    }

}
