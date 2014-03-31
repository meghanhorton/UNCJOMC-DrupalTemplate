<?php

$course_num = $content['field_course_number']['#items'][0]['value'];

echo views_embed_view('course_with_sections','block', $course_num );