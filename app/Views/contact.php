<?php

$errors = $errors ?? [];
$data = $data ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

     /* css for the contact form*/ 
        body {
            min-height: 100vh;
            background-color: #f7f7f8;
        }

        .contact-card {
            border-radius: 12px;
            background-color: #ffffff;
            border: 1px solid #d0d0d5 !important;
        }

        .form-label {
            font-weight: 500;
            color: #343434;
        }

        .brand-name {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #5b2c83;
        }

        .brand-subtitle {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 2px;
        }

        .form-control {
            border-color: #d9d9df;
        }

        .form-control:focus {
            border-color: #7b4aa5;
            box-shadow: 0 0 0 0.15rem rgba(91, 44, 131, 0.12);
        }

        .btn-primary {
            background-color: #5b2c83;
            border-color: #5b2c83;
            border-radius: 8px;
            padding: 0.7rem 1rem;
            font-weight: 500;
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #482269;
            border-color: #482269;
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .alert {
            border-radius: 8px;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">

            <div class="card contact-card shadow-sm">

                <div class="card-body p-4 p-md-5">

                    <!-- Branding -->
                    <div class="text-center mb-4">

                        <div class="brand-name">
                            WEconnectU
                        </div>

                        <div class="brand-subtitle">
                            Blessing Dongo Tech Assessment
                        </div>

                    </div>


                    <!-- Page heading -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-2">

                        <h1 class="h3 fw-semibold mb-0">
                            Contact Us
                        </h1>

                        <a href="/contacts" class="btn btn-outline-secondary btn-sm">
                            View Submissions
                        </a>

                    </div>

                    <p class="text-muted mb-4">
                        Need assistance? Send us a message. We're here to guide you!
                    </p>


                    <!-- Success message -->
                    <?php if ($success): ?>

                        <div class="alert alert-success" role="alert" >

                            <strong>
                                <?= htmlspecialchars($success) ?>
                            </strong>

                        </div>

                    <?php endif; ?>


                    <!-- Validation summary (WHEN THE USER TRIES TO SUBMIT) -->
                    <?php if (!empty($errors)): ?>

                        <div class="alert alert-danger" role="alert">
                            <strong>Please check your details.</strong>
                            Correct the highlighted fields below and try again.
                        </div>

                    <?php endif; ?>


                    <!-- Contact form -->
                    <form id="contact-form" method="POST" action="/" novalidate autocomplete="on">

                        <!-- CSRF protection, security boet! -->
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">


                        <!-- Name -->
                        <div class="mb-3">

                            <label for="name" class="form-label"> Full Name</label>

                            <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($data['name'] ?? '') ?>"
                                autocomplete="name"
                                maxlength="100"
                                required >
                        

                            <?php if (isset($errors['name'])): ?>

                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['name']) ?>
                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- Email -->
                        <div class="mb-3">

                            <label for="email" class="form-label">Email Address</label>

                            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                id="email"
                                name="email"
                                value="<?= htmlspecialchars($data['email'] ?? '') ?>"
                                autocomplete="email"
                                maxlength="255"
                                required >
                            

                            <?php if (isset($errors['email'])): ?>

                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['email']) ?>
                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- Phone -->
                        <div class="mb-3">

                            <label for="phone" class="form-label">Phone Number </label>

                           <div class="input-group">

    <span class="input-group-text">
        🇿🇦 +27
    </span>

    <input
        type="tel" 
        class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
        id="phone"
        name="phone"
        value="<?= htmlspecialchars($data['phone'] ?? '') ?>"
        placeholder="82 123 4567"
        autocomplete="tel"
        inputmode="tel"
        required >

</div>
                            

                            <?php if (isset($errors['phone'])): ?>

                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['phone']) ?>
                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- Message -->
                        <div class="mb-4">

                            <label for="message" class="form-label">
                                Message
                            </label>

                            <textarea
                                class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>"
                                id="message"
                                name="message"
                                rows="5"
                                maxlength="2000"
                                required
                            ><?= htmlspecialchars($data['message'] ?? '') ?>
                            </textarea>

                            <?php if (isset($errors['message'])): ?>

                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['message']) ?>
                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- Submit button -->
                        <button id="submit-button" type="submit" class="btn btn-primary w-100">
                            Send Message
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- Prevent accidental double submissions -->
<script>

    const form = document.getElementById('contact-form');
    const submitButton = document.getElementById('submit-button');

    form.addEventListener('submit', function () {

        submitButton.disabled = true;
        submitButton.textContent = 'Sending...';

    });

</script>

</body>

</html>