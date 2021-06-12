<?php

namespace App\Model\Presenters;

trait UserPresenter
{
    public function allowAccessCourse($courseId)
    {
        return str_contains($this->user_course, $courseId);
    }

    public function allowAccessDeThi($ctDeThi)
    {
        return str_contains($this->user_ct_dethi, $ctDeThi);
    }

    public function showBirthday()
    {
        return $this->birthday ? date('d-m-Y', strtotime($this->birthday)) : '';
    }
}