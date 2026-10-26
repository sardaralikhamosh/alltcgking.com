<?php
// Start session if needed for future features
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---------------------------------------------------------
// FORCE SERVER CACHE CLEAR (Hostinger OPcache)
// ---------------------------------------------------------
if (function_exists('opcache_reset')) {
    opcache_reset();
}

// ---------------------------------------------------------
// CARD INVENTORY — edit this array to add / remove / change cards.
// ---------------------------------------------------------
$cards = [
    ["image" => "images/01.png", "set" => "2025 One Piece OP13 EN",           "name" => "Manga Alternate Art #118 Monkey D. Luffy — PSA 10 Gem Mint",                          "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/02.png", "set" => "2024 One Piece",                    "name" => "The Best Premium Booster OP05-119 Monkey D. Luffy Manga Art SEC — Grade 10 Pristine", "rarity" => "10",  "grade" => "GRADE 10 PRISTINE"],
    ["image" => "images/03.png", "set" => "2026 One Piece OP14-EB04 EN",       "name" => "#051 Buggy 3rd Anniversary – Silver — PSA 10 Gem Mint",                               "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/04.png", "set" => "2026 One Piece OP14-EB04 EN",       "name" => "#051 Buggy 3rd Anniversary – Gold — PSA 10 Gem Mint",                                 "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/05.png", "set" => "2025 One Piece EB02 EN",            "name" => "#001 Monkey D. Dragon Special (Leader) — PSA 10 Gem Mint",                            "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/06.png", "set" => "2025 One Piece EB02 EN",            "name" => "#001 Sabo Special (Leader) — PSA 10 Gem Mint",                                        "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/07.png", "set" => "2024 One Piece",                    "name" => "Emperors In The New World OP09-119 Monkey D. Luffy Manga Alt Art — BGS 10 Pristine", "rarity" => "10",  "grade" => "BGS 10 PRISTINE"],
    ["image" => "images/08.png", "set" => "2025 One Piece EN",                 "name" => "#012 Monkey D. Luffy 3rd Anniversary 3 Brothers PK-Winner Promo — PSA 10 Gem Mint",  "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/09.png", "set" => "2023 One Piece OP02 EN",            "name" => "#026 Sanji Alternate Art — PSA 10 Gem Mint",                                          "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/10-new.png", "set" => "2023 One Piece",                    "name" => "Paramount War Japanese Manga 1 Alt Art #OP03-04 Sanji (Leader) — BGS 10 Pristine",   "rarity" => "10",  "grade" => "BGS 10 PRISTINE"],
    ["image" => "images/11.png", "set" => "2025 One Piece OP11 EN",            "name" => "#119 Monkey D. Luffy 3rd Anniversary – Gold — PSA 10 Gem Mint",                       "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/12.png", "set" => "2025 Union Arena UEPR",             "name" => "REC 25-26 Gold Union Rare #078 Gon Freecss — PSA 10 Gem Mint",                        "rarity" => "10",  "grade" => "PSA 10 GEM MINT"],
    ["image" => "images/13.png", "set" => "2025 One Piece",                    "name" => "Premium Booster: Best Vol.2 OP06-119 Sanji Secret Rare – Manga Alt Art Parallel — CGC Gem Mint 10", "rarity" => "10", "grade" => "CGC 10 GEM MINT"],
    ["image" => "images/14.png", "set" => "2025 One Piece Promo",              "name" => "#ST13-003 Monkey D. Luffy (Leader) — BVB x One Piece Collaboration — BGS 10 Pristine", "rarity" => "10", "grade" => "BGS 10 PRISTINE"],
    ["image" => "images/15-new.png", "set" => "Fleer",                             "name" => "S-S-Scared S-S-Sketches — Hand-Drawn Sketch Card",                                    "rarity" => "1/1", "grade" => "UNGRADED"],
    ["image" => "images/16-new.png", "set" => "Fleer",                             "name" => "S-S-Scared S-S-Sketches — Hand-Drawn Sketch Card",                                    "rarity" => "1/1", "grade" => "UNGRADED"],
    ["image" => "images/17-new.png", "set" => "Fleer",                             "name" => "S-S-Scared S-S-Sketches — Hand-Drawn Sketch Card",                                    "rarity" => "1/1", "grade" => "UNGRADED"],
    ["image" => "images/18.png", "set" => "2024 ONE PIECE",                             "name" => "Gold Roger Card",                                    "rarity" => "1/1", "grade" => "UNGRADED"],
    ["image" => "images/19.png", "set" => "2023 One Piece OPO5 EN",                             "name" => "Monkey D. Luffy",                                    "rarity" => "1/1", "grade" => "UNGRADED"],
    ["image" => "images/20.png", "set" => "2025 One Piece OP13 EN",                             "name" => "SABO",                                    "rarity" => "1/1", "grade" => "UNGRADED"],
    ["image" => "images/21.png", "set" => "2024 One Piece",                             "name" => "MS. All Sunday",                                    "rarity" => "1/1", "grade" => "UNGRADED"],
];

// Helper function for safe HTML output
function e($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ALLTCGKING — Premium Graded Trading Cards</title>
<meta name="description" content="ALLTCGKING is a premium marketplace for graded trading cards — Pokemon, One Piece, Yu-Gi-Oh!, Magic: The Gathering and Dragon Ball Super. Message us for pricing on any card.">
<link rel="icon" href="images/cards-logo.png" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- CACHE BUSTER: The ?v=timestamp forces the browser to download the new CSS immediately -->
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

<!-- ============ HEADER ============ -->
<header class="site-header">
  <div class="container header-inner">
    <a href="index.php" class="brand">
      <img src="images/cards-logo.png" alt="ALLTCGKING" class="brand-logo" width="170" height="48">
    </a>

    <!-- CSS-only mobile menu (no JS required) -->
    <input type="checkbox" id="nav-toggle" class="nav-toggle-input">
    <label for="nav-toggle" class="nav-toggle-btn" aria-label="Toggle menu">
      <span></span>
    </label>

    <nav class="main-nav">
      <a href="index.php">Home</a>
      <a href="cards.php">Shop</a>
      <a href="contact.php">Contact</a>
      <a href="contact.php" class="btn btn-primary nav-cta">Get In Touch</a>
    </nav>
  </div>
</header>

<main>