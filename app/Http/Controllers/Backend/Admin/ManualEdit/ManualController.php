<?php

namespace App\Http\Controllers\Backend\Admin\ManualEdit;

use Sentinel;
use App\Models\Role;
use App\Models\User;
use App\Models\SocialMedia;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\UserTrustee\UserRequest as Request;
use Illuminate\Http\Request as ManulRequest;
use Mail;
use Config;
use Hash;

class ManualController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->middleware('SentinelHasAccess:user-management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.manual-edit-account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->storeUpdate($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->createEdit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManulRequest $request, $id)
    {
        return $this->storeUpdate($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->transaction(function ($model) use ($id) {
            $user = User::find($id);
            $this->deleteAvatar($user->avatar);
            //$user = SocialMedia::where('user_id','=',$id)->get()->first();
            $user->delete();
        }, true);
    }

    /**
     * Datatables for User Trustee Management.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        return datatables(User::datatablesUser(true))
            ->addColumn('action', function ($user) {
                /*$url = route('admin-edit-users', $user->id);*/
                $url = action('Backend\Admin\ManualEdit\ManualController@edit', $user->id);
                $showUrl = route('admin-show-users', $user->id);

                
                $action =  '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Banned" data-id="'.$user->id.'" data-name="'.$user->username.'" data-button="delete"><i class="fa fa-ban fa-fw"></i></a>
                    &nbsp;<a href="'.$showUrl.'" class="btn btn-info btn-xs actShow" title="Show Detail" data-id="'.$user->id.'" data-name="'.$user->username.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';

                return $action;

            })
            ->editColumn('image', function ($user) {
                $pathp = "";

                ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                if ($user->image != ""){
                return "<img src='".asset($pathp.'storage/student/'.$user->image)."' class='img-responsive' width='100px'>";  
                }
            })
            ->editColumn('last_login', function ($user) {
                if (is_null($user->last_login)) {
                    return '--';
                }

                return eform_datetime($user->last_login);
            })
            ->editColumn('name', function ($user) {
                return $user->first_name.' '.$user->last_name;
            })
            ->make(true);
    }

    /**
     * Handle create and edit method.
     *
     * @param  int    $id
     * @return \Illuminate\Http\Response
     */
    protected function createEdit($id = 0)
    {
        $data = [
            'title' => ucfirst(ahloo_form_title($id)),
            'form' => [
                'url' => action('Backend\Admin\ManualEdit\ManualController@store'),
                'files' => true,
            ],
            'user' => [
                'email' => null,
                'first_name' => null,
                'last_name' => null,
                'avatar' => null,
                'role' => null,
                'phone' => null,
                'address' => null,
                'username' =>null
            ],
            'dropdown' => Role::dropdown(),
        ];

        if ($id > 0) {
            $data['form']['url'] = action('Backend\Admin\ManualEdit\ManualController@update', $id);
            $data['form']['method'] = 'POST';
            $data['user'] = User::findOrFail($id);
            $data['user']['role'] = $data['user']->roles[0]->id;
        }
        return view('backend.admin.manual-edit-account.form', $data);
    }

    /**
     * Handle store and update method.
     *
     * @param  App\Http\Requests\Backend\UserTrusteeRequest $request
     * @param  int                                          $id
     * @return \Illuminate\Http\Response
     */
    private function storeUpdate(ManulRequest $request, $id = 0)
    {
        $data = $request->except('_token', 'avatar', 'role');
        
        if ($request->hasFile('avatar')) {
            if ($avatar = $this->processAvatar($request)) {
                $data['avatar'] = $avatar;
            }
        }

        if (! $id) {
            //$data['password'] = str_random();
            $data['password'] = '12345678';
            $data['is_admin'] = true;
        }
        $role = Sentinel::findRoleById($request->role)->slug;
        
        if($role == "member"){
            $password = "";
            for ($i = 0; $i<8; $i++) 
            {
                $password .= mt_rand(0,9);
            }

            $data['password'] = $password;
        }

        $find_data['password'] = $password;
        $find_data['email'] = "";
        $find_data['first_name'] = "";
        $find_data['image'] = "";

        // Saving to database...
        return $this->transaction(function ($model) use ($id, $request, $data, $find_data) {
            if ($id) {
                $user = Sentinel::findById($id);
                if (isset($data['avatar'])) {
                    $this->deleteAvatar($user->avatar);
                }

                $role = Sentinel::findRoleById($user->roles[0]->id);
                $role->users()->detach($user);

                $user = Sentinel::update($user, $data);

                $find_data['email'] = strtolower($user->email);
                $find_data['first_name'] = $user->first_name;
                $find_data['image'] = $user->image;

                Mail::send('email.new_user', $find_data, function($message) use($find_data) {
                            $message->from("noreply@ponpesalihsancbr.id", 'Al-Ihsan No-Reply');
                            $message->to($find_data['email'], $find_data['first_name'])->subject('New Account');
                        });
            } else {
                $user = Sentinel::registerAndActivate($data);
                $roleSlug = strtolower(Role::find($request->input('role'))->slug);
                $data['full_name'] = $data['first_name'].' '.$data['last_name'];
                $data['role_slug'] = $roleSlug;

                // Mail::send('backend.emails.registration', $data, function ($message) use ($data) {
                //     $message->to($data['email'], $data['full_name'])->subject('Your account has registered.');
                // });
            }

            $role = Sentinel::findRoleById($request->input('role'));
            $role->users()->attach($user);
        });
    }

    /**
     * Process avatar file request.
     *
     * @param  \App\Http\Requests\Backend\UserTrusteeRequest $request
     * @return bool|string
     */
    private function processAvatar(Request $request)
    {
        $file = $request->file('avatar');

        if (! $file->isValid()) {
            return false;
        }

        $fileName = date('Y_m_d_His').'_'.$file->getClientOriginalName();

        // Move, move, move!!
        $file->move(avatar_path(), $fileName);

        return $fileName;
    }

    /**
     * Process delete avatar.
     *
     * @param  string $path
     * @return bool
     */
    private function deleteAvatar($path)
    {
        if (! $path) {
            return true;
        }

        $path = avatar_path($path);

        if (! file_exists($path)) {
            return true;
        }

        if (! unlink($path)) {
            return false;
        }

        return true;
    }
}
