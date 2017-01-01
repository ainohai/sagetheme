<?php
/**
 * Template Name: Contact Info Template
 */
?>
<section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam erat, aliquet mollis magna vel, scelerisque finibus mauris. Vestibulum lacus enim, pretium interdum tempor sed, eleifend vitae risus. Sed mauris mauris, feugiat ac convallis vitae, pulvinar sit amet elit. Curabitur gravida ipsum nec pellentesque suscipit. Quisque porttitor eu odio ut consectetur. Aenean tempus aliquam lorem et tincidunt. Nam ut erat sollicitudin, suscipit nisi eget, mattis diam. Duis eleifend ipsum ac libero dignissim, ac feugiat dolor bibendum. Mauris sodales dignissim lectus, nec lacinia dui. Morbi nibh eros, vulputate id neque et, porttitor sollicitudin neque. In tempor ipsum sem.

      Sed in eros ut dolor aliquam volutpat. In hac habitasse platea dictumst. Donec non volutpat mauris, et tristique magna. Suspendisse quis enim posuere, pellentesque odio ut, euismod ipsum. Etiam quis sem ipsum. Nulla consectetur, nisi id vehicula sodales, est lacus placerat magna, finibus vulputate nulla lorem ac turpis. Mauris vulputate urna justo, a dictum nisi congue sed. Suspendisse pharetra urna ac sapien varius, quis pretium eros aliquet. Vestibulum erat nulla, lacinia vel varius ut, pulvinar sit amet urna. Cras aliquet, arcu convallis vestibulum pretium, urna est lobortis leo, in iaculis magna arcu ac quam. Maecenas sit amet fermentum massa, a vestibulum tortor. Suspendisse eget vulputate lorem. Cras tincidunt blandit odio, nec mattis lorem.

      Aliquam tempus ac urna sed porttitor. Nunc tellus risus, posuere at scelerisque euismod, semper sed mauris. Donec erat arcu, tristique in arcu sit amet, porttitor scelerisque nisi. Cras vitae erat eleifend, tincidunt lacus nec, dapibus nisl. Maecenas eget feugiat metus, id lobortis arcu. Donec pellentesque lorem nec rhoncus volutpat. Duis bibendum a metus eu lobortis. Morbi vehicula justo et rutrum pulvinar. Nunc eu auctor augue. Morbi orci arcu, viverra sed nunc eu, placerat consectetur eros. Suspendisse a dictum dolor, sed venenatis magna. Pellentesque massa purus, facilisis a eleifend eu, rutrum a diam. Duis sagittis nunc ante, eu iaculis felis lacinia eget. Nunc eu eros eget dui vulputate volutpat vitae ac metus.

      Mauris varius tellus sed dui malesuada, a scelerisque erat hendrerit. Maecenas hendrerit bibendum nulla at consectetur. Sed efficitur ultricies commodo. Curabitur sit amet lectus quis sapien viverra sollicitudin. Sed quis laoreet turpis, quis vulputate elit. In sit amet ipsum et augue posuere sagittis vitae in nisi. Quisque ipsum leo, faucibus non ullamcorper sed, consequat a sapien. Nunc tempus suscipit augue, in malesuada eros sodales non. Integer aliquet sodales molestie. Sed facilisis odio id massa venenatis lobortis. Maecenas vitae interdum leo. Suspendisse ac laoreet nibh. Nunc pulvinar leo tortor, in suscipit risus viverra tristique.

      Nullam viverra porttitor felis sed consectetur. Proin odio nisl, lacinia nec sollicitudin vitae, finibus at justo. Etiam arcu magna, dignissim dignissim pharetra eget, hendrerit ut justo. Mauris molestie lectus dui, vitae feugiat diam fringilla ut. Vivamus euismod mauris quis urna elementum, eu molestie velit aliquam. Pellentesque facilisis quis tellus et rhoncus. Donec laoreet turpis ut tempor varius. Vivamus in massa vehicula, porta tortor a, viverra tellus. Integer lorem ex, vulputate at pretium sed, sollicitudin non ante. Suspendisse sem est, dignissim gravida lectus at, tristique gravida nulla. Nulla facilisi. Donec gravida tristique magna a gravida. Duis eu fermentum dui. Morbi et ipsum augue. Etiam vel urna ante.</p>
<?php endwhile; ?>
  </section>