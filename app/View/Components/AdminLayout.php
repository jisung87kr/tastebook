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
                        'name' => '관리',
                        'url' => route('admin.posts.index'),
                    ],
                    [
                        'name' => '글쓰기',
                        'url' => route('admin.posts.create'),
                    ]
                ]
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
