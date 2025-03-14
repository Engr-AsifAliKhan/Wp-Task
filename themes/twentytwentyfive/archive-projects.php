<?php
get_header();
?>

<h2>Task Demonstration</h2>

<!-- Tabs Navigation -->
<ul class="task-tabs">
    <li class="tab active" data-tab="projects">Projects</li>
    <li class="tab" data-tab="ajax-fetch">AJAX Fetch</li>
    <li class="tab" data-tab="coffee-image">Random Coffee</li>
    <li class="tab" data-tab="kanye-quotes">Kanye Quotes</li>
</ul>

<!-- Tab Content Containers -->
<div class="tab-content active" id="projects">
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
</div>

<div class="tab-content" id="ajax-fetch">
    <h3>AJAX Fetch</h3>
    <p><strong>Instructions to test:</strong></p>
    <ol>
        <li>Click the "Fetch Architecture Projects" button.</li>
    </ol>
    <button id="fetch-projects">Fetch Architecture Projects</button>
    <div id="ajax-results"></div>
</div>

<div class="tab-content" id="coffee-image">
    <h3>Random Coffee Image</h3>
    <img src="<?php echo hs_give_me_coffee(); ?>" alt="Random Coffee" width="300">
</div>

<div class="tab-content" id="kanye-quotes">
    <h3>Kanye Quotes</h3>
    <?php
    $quotes = hs_get_kanye_quotes();
    if (!empty($quotes)) {
        foreach ($quotes as $quote) {
            echo "<blockquote>$quote</blockquote>";
        }
    } else {
        echo "<p>No quotes found.</p>";
    }
    ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            tabs.forEach(t => t.classList.remove("active"));
            contents.forEach(c => c.classList.remove("active"));

            this.classList.add("active");
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });

    // AJAX Fetch Functionality
    document.getElementById("fetch-projects").addEventListener("click", function () {
        // Use the full URL path instead of a relative path
        fetch('http://localhost/ikonic/wp-admin/admin-ajax.php?action=fetch_architecture_projects')
            .then(response => response.json())
            .then(data => {
                console.log("Fetched Projects:", data); // Logs data in the console
                let resultDiv = document.getElementById("ajax-results");
                resultDiv.innerHTML = "";
                if (data.success && data.data.length > 0) {
                    data.data.forEach(project => {
                        resultDiv.innerHTML += `<p><a href="${project.link}">${project.title}</a></p>`;
                    });
                } else {
                    resultDiv.innerHTML = "<p>No architecture projects found.</p>";
                }
            })
            .catch(error => {
                console.error("Error fetching projects:", error);
                document.getElementById("ajax-results").innerHTML = "<p>Error fetching projects. Check console for details.</p>";
            });
    });
});
</script>

<style>
.task-tabs {
    display: flex;
    list-style: none;
    padding: 0;
    border-bottom: 2px solid #ccc;
}
.task-tabs li {
    padding: 10px 20px;
    cursor: pointer;
    border: 1px solid #ccc;
    margin-right: 5px;
    background: #f8f8f8;
}
.task-tabs .active {
    background: #ddd;
    font-weight: bold;
}
.tab-content {
    display: none;
    padding: 20px;
    border: 1px solid #ccc;
    margin-top: -1px;
}
.tab-content.active {
    display: block;
}
</style>

<?php
get_footer();
?>
