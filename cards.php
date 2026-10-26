<?php
// Include the header (this also loads the $cards array and helper functions)
include 'header.php';
?>

  <!-- ============ SHOP (ALL CARDS) ============ -->
  <section id="shop" class="section">
    <div class="container">
      <div class="section-heading">
        <p class="eyebrow">Full Collection</p>
        <h2>All Cards</h2>
        <p>Browse our complete inventory of graded and authenticated trading cards.</p>
      </div>

      <div class="card-grid">
        <?php foreach ($cards as $card): ?>
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

      <!-- Back to Home Button -->
      <div style="text-align: center; margin-top: 40px;">
        <a href="index.php" class="btn btn-outline">Back to Home</a>
      </div>

    </div>
  </section>

<?php
// Include the footer
include 'footer.php';
?>