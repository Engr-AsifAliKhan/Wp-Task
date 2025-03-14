<?php get_header(); ?>

<div class="projects-container">
    <h1 class="projects-title">Our Projects</h1>

    <div class="projects-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="project-card">
                    <h2 class="project-title"><?php the_title(); ?></h2>
                    <div class="project-excerpt"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="project-link">View Project</a>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="no-projects">No projects found.</p>
        <?php endif; ?>
    </div>

    <!-- Centered Pagination -->
    <div class="pagination">
        <?php 
            echo paginate_links(array(
                'prev_text' => '&laquo; Prev',
                'next_text' => 'Next &raquo;',
            ));
        ?>
    </div>
</div>

<?php get_footer(); ?>
