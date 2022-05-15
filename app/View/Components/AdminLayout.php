<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    public $menu = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = $this->getMenu();
    }

    public function getMenu() :array
    {
        $menu = [
            [
                'name' => '포스팅',
                'url' => null,
                'child' => [
                    [
                        'name' => '리스트',
                        'route' => 'admin.posts.index',
                    ],
                    [
                        'name' => '글쓰기',
                        'route' => 'admin.posts.create',
                    ],
                    [
                        'name' => '카테고리',
                        'route' => 'admin.posts.create',
                    ],
                    [
                        'name' => '댓글',
                        'route' => 'admin.posts.create',
                    ]
                ]
            ],
            [
                'name' => '회원관리',
                'url' => null,
            ],
            [
                'name' => '설정',
                'url' => null,
            ]
        ];
        return $menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.admin');
    }
}
