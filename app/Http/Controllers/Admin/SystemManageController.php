<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Administrator;
use Illuminate\Support\Facades\Storage;
use \PharData;

class SystemManageController extends Controller
{
    //
    public function sysconfig()
    {
        return view('admin.partial_sysconfig');
    }

    public function sysupgrade() {
        return view('admin.partial_sysupgrade');    
    }

    public function dosysupgrade(Request $request) {
        $file = $request->file('patchfile');
        if ($file) {
            $originalName = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $realPath = $file->getRealPath();
            $type = $file->getClientMimeType();
            
            $filename = date('YmdHis',strtotime('+8 hour')).'_'.uniqid().'.tar.'.$ext;

            //$bool = Storage::disk('upgrades')->put($filename, file_get_contents($realPath));
            $newpath = $file->storeAs('',$filename,'upgrades');

            if ($newpath) {
                $phar = new PharData(storage_path().'/app/upgrades/'.$newpath);
                $phar->extractTo(base_path(), null, true);    
            }
            return Response()->json([
                'ret'   => 0,
                'msg'   => 'upload file :'.$filename,
                'basePath'=>base_path(),
                'spath' => $newpath,
                'tmpPath'=> $realPath,
                'origin'=> [
                    'filename'  => $originalName,
                    'ext'       => $ext,
                    'type'      => $type
                ]
            ]);
        } else {
            return Response()->json([
                'ret'   => 0,
                'msg'   => 'no file',
            ]);
                
        }
    }

    public function savesysuserinfo (Request $request) {
        if ($request->isMethod('get')) {
            return 'Unauthorized';    
        }

        if ($request->filled('userid')) {
            $tableColNameMap = [
                'userinfo'      => [
                    'name'    => 'name',
                    'email'    => 'email'
                ]
            ];

            $formdata = $request->all();

            $uid = $request->userid;
            $user = Administrator::find($uid);

            $msg = $user->uuid;
            $needSaveUserinfo = false;

            foreach ($formdata as $key => $value) {
                if (array_key_exists($key,$tableColNameMap['userinfo'])) {
                    if ($user->{$tableColNameMap['userinfo'][$key]} != $value) {
                        $user->{$tableColNameMap['userinfo'][$key]} = $value;
                        $needSaveUserinfo = true;
                    }
                }
            }

            if ($needSaveUserinfo) {
                $user->save();
            }
            return $msg;    
        }     
    }

    public function addsysuser (Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:administrators',
            'name'  => 'required'
        ]);

        $newUser = new Administrator;
        $newUser->name = $request->name;
        $newUser->email = $request->email;

        $pwdstr = str_random(6);
        $newUser->password = bcrypt($pwdstr); 

        $newUser->remember_token = str_random(10);

        $newUser->save();

        return response()->json([
            'msg' => $pwdstr
        ]); 
    }

    public function delsysuser (Request $request) {
        if ($request->filled('userid')) {
            $uid = $request->userid;
            
            $user = Administrator::find($uid);
            
            $user->delete();
            
            return $uid;    
        }    
    }

    public function sysuserinfo (Request $request) {
        if ($request->filled('uid')) {
            $uid = $request->uid;

            $user = Administrator::find($uid);

            return view('admin.partial_sysuserinfo',compact('user'));
        }
    }

    public function sysuser(Request $request)
    {
        $userKwTypes = [
            'Name',
            'Email'
        ];
        $userTableColMap = [
            'name',
            'email'
        ];

        if ($request->filled('cid')) {
            $cid = $request->cid;    

            if ($cid == 'module') {
                $tplName = 'admin.partial_sysuserlist';    
            } else if ($cid == 'userlist'){
                $tplName = 'admin.partial_sysuserlistpage';    
            }

            $users = [];
            $kw = '';
            $kwtype = '';
            if (isset($tplName)) {
                if ($request->filled('kw')) {
                    $kw = $request->kw;
                    $kwtype = $request->kwtype;
                    if (isset($userTableColMap[$kwtype])) {
                        $users = Administrator::whereRaw($userTableColMap[$kwtype].' like ?',[$kw.'%'])->paginate(3); 
                    }
                } else {
                    $users = Administrator::paginate(3);
                }
                return view($tplName, compact('users', 'userKwTypes', 'kw', 'kwtype'));
            }
        }
    }
}
