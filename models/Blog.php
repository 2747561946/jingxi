<?php
namespace models;

class Blog extends Model
{
    protected $table = 'blog';
    protected $fillable = ['title','content','is_show'];


    public function update()
    {

    }

    public function delete()
    {

    }

    public function search()
    {
        
    }
}