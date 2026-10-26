</main>

<!-- ============ FOOTER ============ -->
<footer class="site-footer">
  <div class="container footer-inner">
    <img src="images/cards-logo.png" alt="ALLTCGKING" class="footer-logo" width="140" height="40">
    <p>&copy; <?php echo date("Y"); ?> ALLTCGKING. All rights reserved.</p>
  </div>
</footer>

<script>
  // Progressive enhancement only — the site fully works without this.
  // Because "Message for Pricing" now links directly to contact.php?card=...,
  // this script is no longer needed for pre-filling. However, we keep it
  // for any smooth scroll or future enhancements.
  document.querySelectorAll(".card-inquire").forEach(function (link) {
    // If you want to switch back to JS pre-filling, uncomment the block below.
    /*
    link.addEventListener("click", function (e) {
      // e.preventDefault(); // Uncomment to stop the link and use JS instead
      var cardName = link.getAttribute("data-card");
      var messageBox = document.getElementById("message");
      if (messageBox && !messageBox.value) {
        messageBox.value = "Hi, I'm interested in the \"" + cardName + "\" listing. Could you share pricing and current availability?";
      }
      // window.location.href = "contact.php"; // Uncomment to redirect manually
    });
    */
  });
</script>
</body>
</html>