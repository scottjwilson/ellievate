<?php
/**
 * Template Name: Resources Page
 *
 * Resources page template with blog posts, guides, and downloads.
 *
 * @package Fieldcraft
 */

get_header();
?>

<style>
/* Resources Page Styles */
.resources-hero {
    padding: 10rem 0 5rem;
    background: linear-gradient(135deg, var(--color-neutral-100) 0%, var(--color-neutral-50) 100%);
}

.resources-hero-inner {
    display: grid;
    gap: var(--space-8);
    align-items: center;
}

@media (min-width: 1024px) {
    .resources-hero-inner {
        grid-template-columns: 1fr 1fr;
    }
}

.resources-hero-label {
    display: inline-block;
    font-size: var(--text-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: var(--tracking-widest);
    color: var(--color-primary-600);
    margin-bottom: var(--space-4);
}

.resources-hero h1 {
    font-size: var(--text-hero);
    color: var(--color-dark-900);
    margin-bottom: var(--space-4);
}

.resources-hero-text {
    font-size: var(--text-xl);
    color: var(--color-neutral-600);
    max-width: 480px;
    line-height: var(--leading-relaxed);
}

/* Search Box */
.resources-search {
    background: white;
    border-radius: var(--radius-2xl);
    padding: var(--space-8);
    box-shadow: var(--shadow-xl);
    border: 1px solid var(--color-neutral-200);
}

.search-form {
    display: flex;
    gap: var(--space-3);
}

.search-input {
    flex: 1;
    padding: var(--space-4) var(--space-5);
    font-size: var(--text-base);
    border: 1px solid var(--color-neutral-300);
    border-radius: var(--radius-lg);
    background: var(--color-neutral-50);
    transition: all var(--transition-fast);
}

.search-input:focus {
    outline: none;
    border-color: var(--color-primary-500);
    background: white;
    box-shadow: 0 0 0 3px var(--color-primary-100);
}

.search-input::placeholder {
    color: var(--color-neutral-400);
}

.search-tags {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-2);
    margin-top: var(--space-4);
}

.search-tag {
    padding: var(--space-2) var(--space-4);
    font-size: var(--text-sm);
    font-weight: 500;
    color: var(--color-neutral-600);
    background: var(--color-neutral-100);
    border-radius: var(--radius-full);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.search-tag:hover {
    background: var(--color-primary-100);
    color: var(--color-primary-700);
}

/* Featured Article */
.featured-section {
    padding: var(--section-padding) 0;
    background: white;
}

.featured-card {
    display: grid;
    gap: var(--space-8);
    background: var(--color-primary-600);
    border-radius: var(--radius-3xl);
    overflow: hidden;
}

@media (min-width: 768px) {
    .featured-card {
        grid-template-columns: 1.2fr 1fr;
    }
}

.featured-image {
    aspect-ratio: 16/10;
    overflow: hidden;
}

.featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.featured-content {
    padding: var(--space-8);
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: white;
}

@media (min-width: 768px) {
    .featured-content {
        padding: var(--space-12);
    }
}

.featured-badge {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    font-size: var(--text-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: var(--tracking-wider);
    color: var(--color-accent-400);
    margin-bottom: var(--space-4);
}

.featured-content h2 {
    font-size: var(--text-3xl);
    color: white;
    margin-bottom: var(--space-4);
    line-height: var(--leading-snug);
}

.featured-content p {
    font-size: var(--text-base);
    color: rgba(255, 255, 255, 0.8);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-6);
}

.featured-meta {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    font-size: var(--text-sm);
    color: rgba(255, 255, 255, 0.6);
    margin-top: var(--space-6);
}

/* Categories Section */
.categories-section {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.categories-grid {
    display: grid;
    gap: var(--space-6);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .categories-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .categories-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.category-card {
    background: white;
    border-radius: var(--radius-2xl);
    padding: var(--space-8);
    text-align: center;
    border: 1px solid var(--color-neutral-200);
    transition: all var(--transition-base);
    cursor: pointer;
}

.category-card:hover {
    border-color: var(--color-primary-300);
    box-shadow: var(--shadow-card-hover);
    transform: translateY(-4px);
}

.category-icon {
    width: 4rem;
    height: 4rem;
    margin: 0 auto var(--space-5);
    background: var(--color-primary-100);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary-600);
    transition: all var(--transition-base);
}

.category-card:hover .category-icon {
    background: var(--color-primary-600);
    color: white;
}

.category-card h3 {
    font-size: var(--text-lg);
    margin-bottom: var(--space-2);
}

.category-card p {
    font-size: var(--text-sm);
    color: var(--color-neutral-500);
}

.category-count {
    display: inline-block;
    margin-top: var(--space-4);
    padding: var(--space-1) var(--space-3);
    font-size: var(--text-xs);
    font-weight: 600;
    color: var(--color-primary-600);
    background: var(--color-primary-100);
    border-radius: var(--radius-full);
}

/* Articles Section */
.articles-section {
    padding: var(--section-padding) 0;
    background: white;
}

.articles-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-4);
    margin-bottom: var(--space-8);
}

.articles-grid {
    display: grid;
    gap: var(--space-8);
}

@media (min-width: 768px) {
    .articles-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .articles-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.article-card {
    background: white;
    border-radius: var(--radius-2xl);
    overflow: hidden;
    border: 1px solid var(--color-neutral-200);
    transition: all var(--transition-base);
}

.article-card:hover {
    box-shadow: var(--shadow-card-hover);
    transform: translateY(-4px);
}

.article-image {
    aspect-ratio: 16/10;
    overflow: hidden;
    background: var(--color-neutral-100);
}

.article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--duration-slow) var(--ease-out);
}

.article-card:hover .article-image img {
    transform: scale(1.05);
}

.article-content {
    padding: var(--space-6);
}

.article-category {
    display: inline-block;
    font-size: var(--text-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: var(--tracking-wider);
    color: var(--color-primary-600);
    margin-bottom: var(--space-3);
}

.article-card h3 {
    font-size: var(--text-lg);
    margin-bottom: var(--space-3);
    line-height: var(--leading-snug);
}

.article-card p {
    font-size: var(--text-sm);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-4);
}

.article-meta {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    font-size: var(--text-sm);
    color: var(--color-neutral-500);
}

/* Downloads Section */
.downloads-section {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.downloads-grid {
    display: grid;
    gap: var(--space-6);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .downloads-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.download-card {
    display: flex;
    gap: var(--space-5);
    background: white;
    border-radius: var(--radius-2xl);
    padding: var(--space-6);
    border: 1px solid var(--color-neutral-200);
    transition: all var(--transition-base);
}

.download-card:hover {
    border-color: var(--color-primary-300);
    box-shadow: var(--shadow-card);
}

.download-icon {
    width: 3.5rem;
    height: 3.5rem;
    background: var(--color-accent-100);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent-600);
    flex-shrink: 0;
}

.download-content {
    flex: 1;
}

.download-content h3 {
    font-size: var(--text-base);
    margin-bottom: var(--space-2);
}

.download-content p {
    font-size: var(--text-sm);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-3);
}

.download-meta {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    font-size: var(--text-xs);
    color: var(--color-neutral-500);
}

/* Newsletter Section */
.newsletter-section {
    padding: var(--section-padding) 0;
    background: var(--color-dark-950);
    position: relative;
    overflow: hidden;
}

.newsletter-section::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    background-size: 30px 30px;
    pointer-events: none;
}

.newsletter-inner {
    display: grid;
    gap: var(--space-8);
    align-items: center;
    position: relative;
}

@media (min-width: 768px) {
    .newsletter-inner {
        grid-template-columns: 1fr 1fr;
    }
}

.newsletter-content h2 {
    font-size: var(--text-4xl);
    color: white;
    margin-bottom: var(--space-4);
}

.newsletter-content p {
    font-size: var(--text-lg);
    color: var(--color-dark-300);
    line-height: var(--leading-relaxed);
}

.newsletter-form {
    display: flex;
    gap: var(--space-3);
    flex-wrap: wrap;
}

.newsletter-input {
    flex: 1;
    min-width: 200px;
    padding: var(--space-4) var(--space-5);
    font-size: var(--text-base);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-lg);
    background: rgba(255, 255, 255, 0.1);
    color: white;
    transition: all var(--transition-fast);
}

.newsletter-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.newsletter-input:focus {
    outline: none;
    border-color: var(--color-accent-400);
    background: rgba(255, 255, 255, 0.15);
}

.newsletter-note {
    margin-top: var(--space-4);
    font-size: var(--text-sm);
    color: var(--color-dark-400);
}
</style>

<!-- Hero Section -->
<section class="resources-hero">
    <div class="container">
        <div class="resources-hero-inner">
            <div class="reveal">
                <span class="resources-hero-label">Resources</span>
                <h1>Insights & inspiration</h1>
                <p class="resources-hero-text">
                    Explore our collection of articles, guides, and resources to help you build a stronger digital presence.
                </p>
            </div>
            <div class="resources-search reveal reveal-delay-1">
                <form class="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <input type="text" name="s" class="search-input" placeholder="Search articles...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                <div class="search-tags">
                    <span class="search-tag">Web Design</span>
                    <span class="search-tag">SEO</span>
                    <span class="search-tag">Marketing</span>
                    <span class="search-tag">Development</span>
                    <span class="search-tag">Branding</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Article -->
<section class="featured-section">
    <div class="container">
        <div class="featured-card reveal">
            <div class="featured-image">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=500&fit=crop" alt="Website Redesign Guide">
            </div>
            <div class="featured-content">
                <span class="featured-badge">
                    <?php echo fieldcraft_icon("star"); ?>
                    Featured Guide
                </span>
                <h2>The Complete Guide to Website Redesign in 2024</h2>
                <p>
                    Everything you need to know about planning, executing, and launching a successful website redesign that drives results.
                </p>
                <a href="#" class="btn btn-accent">
                    Read the Guide <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
                <div class="featured-meta">
                    <span>25 min read</span>
                    <span>Updated Jan 2024</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="categories-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Topics</span>
            <h2 class="text-display">Browse by category</h2>
        </div>

        <div class="categories-grid">
            <div class="category-card reveal">
                <div class="category-icon">
                    <?php echo fieldcraft_icon("palette", 28); ?>
                </div>
                <h3>Design</h3>
                <p>UI/UX, trends, and best practices</p>
                <span class="category-count">24 articles</span>
            </div>

            <div class="category-card reveal reveal-delay-1">
                <div class="category-icon">
                    <?php echo fieldcraft_icon("code", 28); ?>
                </div>
                <h3>Development</h3>
                <p>Technical guides and tutorials</p>
                <span class="category-count">18 articles</span>
            </div>

            <div class="category-card reveal reveal-delay-2">
                <div class="category-icon">
                    <?php echo fieldcraft_icon("search", 28); ?>
                </div>
                <h3>SEO</h3>
                <p>Rankings, traffic, and visibility</p>
                <span class="category-count">15 articles</span>
            </div>

            <div class="category-card reveal reveal-delay-3">
                <div class="category-icon">
                    <?php echo fieldcraft_icon("megaphone", 28); ?>
                </div>
                <h3>Marketing</h3>
                <p>Strategy, campaigns, and growth</p>
                <span class="category-count">21 articles</span>
            </div>
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="articles-section">
    <div class="container">
        <div class="articles-header reveal">
            <h2 class="text-display">Latest articles</h2>
            <a href="#" class="btn btn-outline">View All <?php echo fieldcraft_icon("arrow-right"); ?></a>
        </div>

        <div class="articles-grid">
            <article class="article-card reveal">
                <div class="article-image">
                    <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&h=300&fit=crop" alt="Article">
                </div>
                <div class="article-content">
                    <span class="article-category">Web Design</span>
                    <h3>10 Web Design Trends to Watch in 2024</h3>
                    <p>Discover the latest design trends shaping the web and how to apply them to your projects.</p>
                    <div class="article-meta">
                        <span>8 min read</span>
                        <span>Jan 15, 2024</span>
                    </div>
                </div>
            </article>

            <article class="article-card reveal reveal-delay-1">
                <div class="article-image">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500&h=300&fit=crop" alt="Article">
                </div>
                <div class="article-content">
                    <span class="article-category">SEO</span>
                    <h3>Core Web Vitals: A Complete Guide</h3>
                    <p>Everything you need to know about Google's Core Web Vitals and how to optimize for them.</p>
                    <div class="article-meta">
                        <span>12 min read</span>
                        <span>Jan 12, 2024</span>
                    </div>
                </div>
            </article>

            <article class="article-card reveal reveal-delay-2">
                <div class="article-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500&h=300&fit=crop" alt="Article">
                </div>
                <div class="article-content">
                    <span class="article-category">Strategy</span>
                    <h3>How to Build a Successful Brand Online</h3>
                    <p>A step-by-step guide to building a strong brand presence in the digital age.</p>
                    <div class="article-meta">
                        <span>10 min read</span>
                        <span>Jan 10, 2024</span>
                    </div>
                </div>
            </article>

            <article class="article-card reveal">
                <div class="article-image">
                    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=500&h=300&fit=crop" alt="Article">
                </div>
                <div class="article-content">
                    <span class="article-category">Development</span>
                    <h3>WordPress vs Headless CMS: Which to Choose?</h3>
                    <p>Comparing traditional WordPress with headless solutions for modern web projects.</p>
                    <div class="article-meta">
                        <span>15 min read</span>
                        <span>Jan 8, 2024</span>
                    </div>
                </div>
            </article>

            <article class="article-card reveal reveal-delay-1">
                <div class="article-image">
                    <img src="https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?w=500&h=300&fit=crop" alt="Article">
                </div>
                <div class="article-content">
                    <span class="article-category">Marketing</span>
                    <h3>Content Marketing Strategy That Works</h3>
                    <p>How to create a content marketing strategy that drives traffic and conversions.</p>
                    <div class="article-meta">
                        <span>9 min read</span>
                        <span>Jan 5, 2024</span>
                    </div>
                </div>
            </article>

            <article class="article-card reveal reveal-delay-2">
                <div class="article-image">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=500&h=300&fit=crop" alt="Article">
                </div>
                <div class="article-content">
                    <span class="article-category">Business</span>
                    <h3>When to Invest in a Website Redesign</h3>
                    <p>Signs it's time to redesign your website and how to make the case for investment.</p>
                    <div class="article-meta">
                        <span>7 min read</span>
                        <span>Jan 3, 2024</span>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Downloads Section -->
<section class="downloads-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Free Downloads</span>
            <h2 class="text-display">Templates & guides</h2>
            <p>Practical resources to help you plan and execute your digital projects.</p>
        </div>

        <div class="downloads-grid">
            <div class="download-card reveal">
                <div class="download-icon">
                    <?php echo fieldcraft_icon("chart", 24); ?>
                </div>
                <div class="download-content">
                    <h3>Website Project Brief Template</h3>
                    <p>A comprehensive template to help you define requirements and goals for your website project.</p>
                    <div class="download-meta">
                        <span>PDF</span>
                        <span>2.4 MB</span>
                    </div>
                </div>
            </div>

            <div class="download-card reveal reveal-delay-1">
                <div class="download-icon">
                    <?php echo fieldcraft_icon("search", 24); ?>
                </div>
                <div class="download-content">
                    <h3>SEO Audit Checklist</h3>
                    <p>50-point checklist to audit your website's SEO and identify improvement opportunities.</p>
                    <div class="download-meta">
                        <span>PDF</span>
                        <span>1.8 MB</span>
                    </div>
                </div>
            </div>

            <div class="download-card reveal">
                <div class="download-icon">
                    <?php echo fieldcraft_icon("layers", 24); ?>
                </div>
                <div class="download-content">
                    <h3>Brand Guidelines Template</h3>
                    <p>Figma template for creating professional brand guidelines for your business.</p>
                    <div class="download-meta">
                        <span>Figma</span>
                        <span>Free</span>
                    </div>
                </div>
            </div>

            <div class="download-card reveal reveal-delay-1">
                <div class="download-icon">
                    <?php echo fieldcraft_icon("target", 24); ?>
                </div>
                <div class="download-content">
                    <h3>Content Marketing Calendar</h3>
                    <p>12-month content calendar template to plan and organize your content strategy.</p>
                    <div class="download-meta">
                        <span>Spreadsheet</span>
                        <span>Free</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-inner">
            <div class="newsletter-content reveal">
                <h2>Get insights delivered</h2>
                <p>Subscribe to our newsletter for the latest articles, guides, and industry insights. No spam, just valuable content.</p>
            </div>
            <div class="reveal reveal-delay-1">
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Enter your email">
                    <button type="submit" class="btn btn-accent">Subscribe</button>
                </form>
                <p class="newsletter-note">Join 5,000+ subscribers. Unsubscribe anytime.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
