<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Submissions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>

        /* css for the submissions list */
        body {
            min-height: 100vh;
            background-color: #f7f7f8;
        }

        .submissions-card {
            border-radius: 12px;
            background-color: #ffffff;
            border: 1px solid #d0d0d5 !important;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            white-space: nowrap;
        }

        .message-cell {
            min-width: 280px;
            max-width: 450px;
            white-space: normal;
            word-break: break-word;
        }

        .btn-primary {
            background-color: #5b2c83;
            border-color: #5b2c83;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-weight: 500;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #482269;
            border-color: #482269;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Contact Submissions</h1>
           <p class="text-muted mb-0"> Messages received through the contact form.
    <?= count($contacts) ?> submission<?= count($contacts) === 1 ? '' : 's' ?>.
</p>
        </div>

        <a href="/" class="btn btn-primary"> New Message</a>
    </div>

    <?php if (empty($contacts)): ?>

        <div class="alert alert-info" role="alert"> No contact submissions have been received yet </div>

    <?php else: ?>

        <div class="card submissions-card shadow-sm">
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Date of Submission</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($contact['name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($contact['email']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($contact['phone']) ?>
                            </td>

                            <td class="message-cell"> <?= htmlspecialchars($contact['message']) ?></td>

                            <td> <?= date('d M Y, H:i', strtotime($contact['created_at'])) ?></td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

</div>

</body>
</html>