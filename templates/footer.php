<footer class="mdl-mega-footer">
    <?php dynamic_sidebar('sidebar-footer'); ?>

    <div class="mdl-grid">
        <aside class="mdl-cell mdl-cell--4-col">
            <?php $researchTopics->echoResearchTopicNav(); ?>
        </aside>

        <div class="mdl-cell mdl-cell--4-col">
            <?php $researchTopics->echoPosts(); ?>
        </div>
    </div>
</footer>