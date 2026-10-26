<?php
// Include the header (this also loads the $cards array and helper functions)
include 'header.php';

// ---------------------------------------------------------
// CONTACT FORM HANDLING
// ---------------------------------------------------------
$recipient_email = "info@alltcgking.com";
$form_error   = "";
$form_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Honeypot spam trap — real visitors never fill this in
    if (!empty($_POST['website'])) {
        header("Location: contact.php?sent=1");
        exit;
    }

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? 'General Question');
    $message = trim($_POST['message'] ?? '');

    $name    = strip_tags($name);
    $phone   = strip_tags($phone);
    $subject = strip_tags($subject);
    $message = strip_tags($message);

    if ($name === '' || strlen($name) < 2) {
        $form_error = "Please enter your full name.";
    } elseif ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_error = "Please enter a valid email address.";
    } elseif ($message === '' || strlen($message) < 5) {
        $form_error = "Please enter a message.";
    } else {
        $mail_subject = "[ALLTCGKING] New Inquiry: $subject";

        $body  = "You have a new message from the ALLTCGKING website.\n\n";
        $body .= "----------------------------------------\n";
        $body .= "Name:    $name\n";
        $body .= "Email:   $email\n";
        $body .= "Phone:   " . ($phone !== '' ? $phone : "Not provided") . "\n";
        $body .= "Subject: $subject\n";
        $body .= "----------------------------------------\n\n";
        $body .= "Message:\n$message\n\n";
        $body .= "----------------------------------------\n";
        $body .= "Submitted: " . date("F j, Y g:i A") . "\n";
        $body .= "IP Address: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";

        $from_address = "noreply@alltcgking.com";
        $headers  = "From: ALLTCGKING Website <$from_address>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $sent = @mail($recipient_email, $mail_subject, $body, $headers);

        if ($sent) {
            header("Location: contact.php?sent=1");
            exit;
        } else {
            $form_error = "We couldn't send your message right now. Please email info@alltcgking.com directly.";
        }
    }
}

$form_success = isset($_GET['sent']) && $_GET['sent'] == '1';

// Check if a card name was passed in the URL
$inquiry_card = isset($_GET['card']) ? trim($_GET['card']) : '';
$prefilled_message = '';
if ($inquiry_card !== '') {
    $prefilled_message = "Hi, I'm interested in the \"" . $inquiry_card . "\" listing. Could you share pricing and current availability?";
}
?>

  <!-- ============ CONTACT ============ -->
  <section id="contact" class="section section-alt">
    <div class="container">
      <div class="section-heading">
        <p class="eyebrow">Get In Touch</p>
        <h2>Let's Talk Cards</h2>
        <p>Pricing, trades, want-lists, or bulk offers — send a message and we'll reply within 24 hours.</p>
      </div>

      <div class="contact-grid">

        <div class="contact-info-card">
          <h3>Contact Information</h3>
          <p>Reach out directly, or use the form and we'll follow up by email.</p>
          <ul class="contact-info-list">
            <li><span class="label">Email</span><a href="mailto:info@alltcgking.com">info@alltcgking.com</a></li>
            <li><span class="label">Phone</span><a href="tel:+14242731193">(424) 273-1193</a></li>
            <li><span class="label">Based In</span><span class="value">Los Angeles, CA — Shipping Worldwide</span></li>
            <li><span class="label">Response Time</span><span class="value">Within 24 hours</span></li>
          </ul>
        </div>

        <div class="contact-form-card">

          <?php if ($form_success): ?>
            <div class="form-status success">Thanks — your message has been sent. We'll be in touch within 24 hours.</div>
          <?php endif; ?>

          <?php if ($form_error !== ''): ?>
            <div class="form-status error"><?php echo e($form_error); ?></div>
          <?php endif; ?>

          <div class="inquiry-banner <?php echo ($inquiry_card !== '') ? 'show' : ''; ?>" id="inquiry-banner">
            <span id="inquiry-text"><?php echo ($inquiry_card !== '') ? 'Inquiring about: ' . e($inquiry_card) : ''; ?></span>
          </div>

          <form action="contact.php" method="POST" novalidate>

            <!-- Honeypot spam trap — keep hidden -->
            <div class="hp-field" aria-hidden="true">
              <label for="website">Leave this field empty</label>
              <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-row">
              <div class="field">
                <label for="name">Full Name <span class="req">*</span></label>
                <input type="text" id="name" name="name" required autocomplete="name">
              </div>
              <div class="field">
                <label for="email">Email Address <span class="req">*</span></label>
                <input type="email" id="email" name="email" required autocomplete="email">
              </div>
            </div>

            <div class="form-row">
              <div class="field">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" autocomplete="tel">
              </div>
              <div class="field">
                <label for="subject">Subject</label>
                <select id="subject" name="subject">
                  <option value="Pricing Inquiry">Pricing Inquiry</option>
                  <option value="Want List / Card Request">Want List / Card Request</option>
                  <option value="Sell or Trade a Card">Sell or Trade a Card</option>
                  <option value="Order / Shipping Question">Order / Shipping Question</option>
                  <option value="General Question">General Question</option>
                </select>
              </div>
            </div>

            <div class="field">
              <label for="message">Message <span class="req">*</span></label>
              <textarea id="message" name="message" required placeholder="Tell us which card you're interested in, along with any grading or pricing questions..."><?php echo e($prefilled_message); ?></textarea>
            </div>

            <button type="submit" class="btn btn-dark btn-block">Send Message</button>
          </form>
        </div>

      </div>
    </div>
  </section>

<?php
// Include the footer
include 'footer.php';
?>