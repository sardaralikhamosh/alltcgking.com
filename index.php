<?php
// Include the header (this also loads the $cards array and helper functions)
include 'header.php';

// We only want to show the first 12 cards (3 rows of 4)
$homepage_cards = array_slice($cards, 0, 12);
?>

  <!-- ============ HOME / HERO ============ -->
  <section id="home" class="hero">
    <div class="container hero-inner">
      <div class="hero-copy">
        <p class="eyebrow">Graded &amp; Authenticated</p>
        <h1>Premium Trading Cards, <span>Fit for a King</span></h1>
        <p class="hero-text">From black-label One Piece alt arts to gem-mint Pokemon promos — ALLTCGKING curates the highest grade cards across every major trading card game. Buy, sell, and trade with confidence.</p>
        <div class="hero-buttons">
          <a href="cards.php" class="btn btn-primary">Browse Collection</a>
          <a href="contact.php" class="btn btn-outline">Talk to Us</a>
        </div>
        <div class="hero-stats">
          <div><strong>500+</strong><span>Graded Cards</span></div>
          <div><strong>5</strong><span>TCGs Covered</span></div>
          <div><strong>10/10</strong><span>Grading Standard</span></div>
        </div>
      </div>
      <div class="hero-image">
        <img src="images/Banner-Image-updated.png" alt="Featured graded card">
      </div>
    </div>
  </section>

  <!-- ============ WHY US ============ -->
  <section class="section section-alt">
    <div class="container">
      <div class="trust-grid">
        <div class="trust-item">
          <h4>Authenticated Grading</h4>
          <p>Every card is verified and graded by BGS or PSA before it's listed.</p>
        </div>
        <div class="trust-item">
          <h4>New Drops Weekly</h4>
          <p>Fresh pulls and estate acquisitions added every week.</p>
        </div>
        <div class="trust-item">
          <h4>Worldwide Shipping</h4>
          <p>Fully insured, tracked shipping on every order.</p>
        </div>
        <div class="trust-item">
          <h4>Direct Pricing</h4>
          <p>Message us on any listing for pricing, bundles, and trades.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ SHOP (HOMEPAGE PREVIEW) ============ -->
  <section id="shop" class="section">
    <div class="container">
      <div class="section-heading">
        <p class="eyebrow">Collection</p>
        <h2>Shop Cards</h2>
        <p>Every listing is graded, authenticated, and ready to ship. Message us on any card for current pricing.</p>
      </div>

      <div class="card-grid">
        <?php foreach ($homepage_cards as $card): ?>
        <article class="tcg-card">
          <div class="tcg-card-media">
            <img src="<?php echo e($card['image']); ?>" alt="<?php echo e($card['name']); ?>" loading="lazy" width="400" height="500">
            <span class="tcg-badge"><?php echo e($card['rarity']); ?></span>
            <span class="tcg-card-grade"><?php echo e($card['grade']); ?></span>
          </div>
          <div class="tcg-card-body">
            <span class="tcg-card-set"><?php echo e($card['set']); ?></span>
            <h3 class="tcg-card-name"><?php echo e($card['name']); ?></h3>
            <a href="contact.php?card=<?php echo urlencode($card['name']); ?>" class="btn btn-ghost-accent card-inquire" data-card="<?php echo e($card['name']); ?>">
              Message for Pricing
            </a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>

      <!-- VIEW MORE BUTTON -->
      <div style="text-align: center; margin-top: 40px;">
        <a href="cards.php" class="btn btn-primary" style="padding: 14px 40px; font-size: 1rem;">View More Cards</a>
      </div>

    </div>
  </section>

<?php
// Include the footer
include 'footer.php';
?>