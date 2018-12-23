<?php

namespace Tests\Unit;

use App\TheLoai;
use App\User;
use Tests\TestCase;
use Auth;
use Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_login_page_admin()
    {
        $response = $this->get('/admin/dangnhap'); //đăng nhập tài khoản admin
        $response->assertStatus(200);//kiểm tra trạng thái của trang web, 200 là trả về view

    }
    public function test_login_admin()
    {

        $dangnhap = $this->post(route('login'), [

            'email' => 'hongocluan1993@gmail.com',
            'password' => '123456',

        ]); //đăng nhập tài khoản customer
        $this->assertTrue(Auth::check());//da dang nhap
    }
    public function test_create_a_theloai()
    {
        $user = User::first();
        $this->actingAs($user);
        $response = $this->post('/admin/theloai/them', [

            'txtCateName' => 'API',

        ]);
//        dd($response);
        $theloai = TheLoai::where('Ten','API')->first();
        $this->assertTrue(Auth::check());//da dang nhap
        $this->assertEquals('API', $theloai->Ten);

    }

    public function test_edit_admin_theloai()
    {
        $user = User::first();
        $this->actingAs($user);

        $theloai = TheLoai::latest()->first();
        $response = $this->post('/admin/theloai/sua/' . $theloai->id, [

            'txtCateName' => 'Mobile2',
        ]);
        $theloaicurrent = TheLoai::latest()->first();
        $this->assertTrue(Auth::check());
        $this->assertEquals('Mobile2', $theloaicurrent->Ten);

    }


}
