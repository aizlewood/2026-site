<?php

echo page('writes')->children()->visible()->flip()->limit(10)->feed(array(
  'title'       => 'Jon Aizlewood: Latest articles',
  'description' => 'Read the latest news about our company',
  'link'        => 'blog',
  'descriptionField'  => 'text', 
  'descriptionLength' => 200
));

?>