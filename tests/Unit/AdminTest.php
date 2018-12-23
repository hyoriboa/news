<?php

namespace Tests\Unit;

use App\TheLoai;
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

        $dangnhap = $this->post('/admin/dangnhap', [

            'email' => 'hongocluan1993@mail.com',
            'password' => '123456',

        ]); //đăng nhập tài khoản customer
        $this->assertTrue(Auth::guard('admin')->check());//da dang nhap
    }
    public function test_create_a_theloai()
    {
        Auth::guard('admin')->attempt(['email' => 'hongocluan1993@mail.com', 'password' => '123456']);//ham dang nhap admin
        $response = $this->post('/admin/category-add', [

            'Ten' => 'API',

        ]);
        $theloai = TheLoai::latest()->first();
        $this->assertTrue(Auth::guard('admin')->check());//da dang nhap
        $this->assertEquals('API', $theloai->Ten);

    }


}
