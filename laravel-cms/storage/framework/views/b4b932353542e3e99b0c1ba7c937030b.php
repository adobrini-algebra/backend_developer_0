<div class="p-4 mb-6 inline-flex w-full sm:p-8 bg-white shadow sm:rounded-lg hover:shadow-lg" >
    <section class="space-y-6 w-full">
        <header>
            <div class="flex items-center justify-between">
                <a href="<?php echo e(route('articles.show', $article->id)); ?>" class="text-lg font-medium text-gray-900 py-2 inline-flex"><?php echo e($article->title); ?></a>
                <a href="<?php echo e(route('category.articles', $article->category)); ?>" class="cursor-pointer rounded-full bg-indigo-400 mx-8 px-3 py-1.5 text-white hover:bg-indigo-300"><?php echo e($article->category->name); ?></a>
            </div>
            <p>Written by <i><a href="<?php echo e(route('user.articles', $article->author)); ?>" class="cursor-pointer text-blue-600 underline"><?php echo e($article->author->fullName()); ?></a></i> on <i><?php echo e($article->created_at->toFormattedDateString()); ?></i></p>
        </header>
        <a href="<?php echo e(route('articles.show', $article->id)); ?>">
            <p class="my-4 text-gray-600"><?php echo e($article->body); ?></p>
        </a>
        <footer class="flex gap-3">
            <?php $__currentLoopData = $article->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('tag.articles', $tag)); ?>" class="cursor-pointer rounded-full bg-gray-100 px-3 py-1.5 text-xs text-gray-600 hover:bg-gray-200"><?php echo e($tag->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </footer>
    </section>
</div><?php /**PATH /var/www/backend_developer_0/laravel-cms/resources/views/articles/partials/article.blade.php ENDPATH**/ ?>