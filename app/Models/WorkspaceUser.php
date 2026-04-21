<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class WorkspaceUser extends Pivot
{
    use HasUlids;

    /**
     * Tên bảng pivot.
     *
     * @var string
     */
    protected $table = 'workspace_user';

    /**
     * Chỉ định khóa chính không tự tăng.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Kiểu dữ liệu của khóa chính.
     *
     * @var string
     */
    protected $keyType = 'string';
}
