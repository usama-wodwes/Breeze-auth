<?php
namespace App\Models;
    class ListModel{
        public static function all(){
            return [
                [
                    'id'=>1,
                    'title'=>'Title 1',
                    'description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque veniam vitae aut enim distinctio ipsa perferendis eum! Corporis minima error, cum officiis quo mollitia aperiam porro ipsam, similique recusandae sed?'
                ],
                [
                    'id'=>2,
                    'title'=>'Title 2',
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas facilisis, velit sit amet condimentum vulputate, metus ex finibus justo, vel consectetur mauris velit sed neque. Suspendisse potenti.'
                ],
                [
                    'id'=>3,
                    'title'=>'Title 3',
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vel dolor a enim faucibus fermentum. Nulla facilisi.'
                ],

                ];
        }
        public static function find($id){
            $listings=self::all();
            foreach($listings as $list){
                if($list['id']==$id){
                    return $list;
                }
            }
        }
    }

?>
