<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Artisan;
use Sentinel;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
   public function initRoles()
   {
        $adminRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'admin',
            'slug' => 'admin',
            'permissions' => [
                'product.manage' => true,
                'user.manage' => true,
                'order.manage'=>true,
                'product.purchase' => false
            ]
        ]);
        $adminRole->save();

        $userRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'customer',
            'slug' => 'customer',
            'permissions' => [
                'product.manage' => false,
                'user.manage' => false,
                'order.manage'=> false,
                'product.purchase' => true
            ]
        ]);
        $userRole->save();
        return redirect()->route('dashboard');
   }

   public function initAdmin()
   {
        $admin = [
            'email' => 'abel@parableu.com',
            'password' =>'password',
        ];
        $admin = Sentinel::registerAndActivate($admin);
        $admin->active = 1;
        $admin->save();
        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($admin);
        return redirect()->route('dashboard');
   }

   public function initApp(){

        //init Roles
        $adminRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'admin',
            'slug' => 'admin',
            'permissions' => [
                'product.manage' => true,
                'user.manage' => true,
                'order.manage'=>true,
                'product.purchase' => false
            ]
        ]);
        $adminRole->save();
        //init Roles
        $staffRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'staff',
            'slug' => 'staff',
            'permissions' => [
                'product.manage' => false,
                'user.manage' => false,
                'order.manage'=>true,
                'product.purchase' => false
            ]
        ]);
        $staffRole->save();

        $userRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'customer',
            'slug' => 'customer',
            'permissions' => [
                'product.manage' => false,
                'user.manage' => false,
                'order.manage'=> false,
                'product.purchase' => true
            ]
        ]);
        $userRole->save();

        
        //init anonyms
        $user = [
            'email' => 'anonymous@parableu.com',
            'password' =>'password',
        ];
        $user = Sentinel::registerAndActivate($user);
        $user->active = 1;
        $user->save();
        $role = Sentinel::findRoleBySlug('customer');
        $role->users()->attach($user);

        //init admin
        $admin = [
            'email' => 'abel@parableu.com',
            'password' =>'password',
        ];
        $admin = Sentinel::registerAndActivate($admin);
        $admin->active = 1;
        $admin->mobile = '9952110335';
        $admin->save();
        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($admin);


        //setup init seeds
        Artisan::call('db:seed');


        return back();
   }
}
