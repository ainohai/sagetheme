<div class="editable" data-inputType = "textArea" data-apiKey = "content:rendered">
<?php the_content(); ?>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
