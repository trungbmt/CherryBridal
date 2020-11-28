<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{	
	public $timestamps = false;
    protected $fillable = [
    	'tag_text',
    	'tag_status'
    ];
    protected $primaryKey = 'tag_id';
    protected $table = 'tbl_tag';
}
