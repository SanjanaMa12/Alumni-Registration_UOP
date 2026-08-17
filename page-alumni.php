<?php
/*
Template Name: Alumni Registration
*/

get_header(); 

global $wpdb;
$s_table_name = $wpdb->prefix . 's_alumni'; // Table nameත් s_ වුනා

$s_error = '';
$s_success = '';

// Form Submit
if(isset($_POST['s_submit_alumni'])) {
    $s_name = sanitize_text_field($_POST['s_name']);
    $s_email = sanitize_email($_POST['s_email']);
    $s_graduation_year = intval($_POST['s_graduation_year']);

    if($s_graduation_year > 2026 || $s_graduation_year < 1950) {
        $s_error = "Graduation year must be between 1950 and 2026.";
    } else {
        $s_inserted = $wpdb->insert(
            $s_table_name,
            array('full_name' => $s_name, 'email' => $s_email, 'graduation_year' => $s_graduation_year),
            array('%s', '%s', '%d')
        );
        if($s_inserted) {
            $s_success = "Alumni details saved successfully!";
            echo "<script>window.location.href = '".get_permalink()."';</script>"; 
        }
    }
}

// Get Records
$s_results = $wpdb->get_results("SELECT * FROM $s_table_name ORDER BY id ASC");
?>

<!-- CSS -->
<style>
    body { background: #f4f4f4; }

    .s-container { max-width: 1000px; margin: 30px auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif; }

    /* HEADER - Lighter Blue to Yellow Gradient */
    .s-header { 
        background: linear-gradient(135deg, #2a5a9a 0%, #3a6ea5 50%, #ffb400 100%); /* Dark blue ටික light කළා */
        padding: 30px; 
        text-align: center; 
        color: white; 
        border-radius: 12px 12px 0 0; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .s-header img { height: 90px; margin-bottom: 10px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3)); }
    .s-header h1 { 
        margin: 0; font-size: 32px; font-weight: 800; /* Bold කළා */
        text-shadow: 2px 2px 6px rgba(0,0,0,0.6); /* Shadow දැම්මා */
        color: #ffffff; /* Pure white */
    }
    .s-header h2 { 
        margin: 8px 0 0 0; font-size: 20px; font-weight: 600; 
        color: #fff9e6; /* Bright yellowish white */
        text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
    }

    /* FORM */
    .s-form { 
        background: linear-gradient(to bottom, #fffdf7, #fff8e1); 
        padding: 30px; 
        border-radius: 0 0 12px 12px; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        margin-bottom: 40px; 
        border-top: 4px solid #ffb400;
    }
    .s-form label { font-weight: bold; color: #2a5a9a; } /* Label colorත් light blue කළා */
    .s-form input { 
        width: 100%; padding: 12px; margin-top: 5px; margin-bottom: 15px; 
        border: 2px solid #ffd54f; border-radius: 6px; box-sizing: border-box; 
        transition: 0.3s;
    }
    .s-form input:focus { border-color: #3a6ea5; outline: none; box-shadow: 0 0 8px rgba(58,110,165,0.3); }

    /* BUTTON */
    .s-btn { 
        padding: 12px 30px; 
        background: linear-gradient(90deg, #ffb400, #ffca28); 
        color: #2a5a9a; /* Text color dark blue */
        border: none; 
        border-radius: 6px; 
        cursor: pointer; 
        font-size: 16px; 
        font-weight: bold; 
        transition: 0.3s;
        box-shadow: 0 3px 8px rgba(255,180,0,0.3);
    }
    .s-btn:hover { 
        background: linear-gradient(90deg, #3a6ea5, #2a5a9a); 
        color: white;
        transform: translateY(-2px);
    }

    /* TABLE */
    .s-table { 
        width: 100%; border-collapse: collapse; margin-top: 20px; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-radius: 12px; overflow: hidden; 
    }
    .s-table th { 
        background: linear-gradient(90deg, #2a5a9a, #3a6ea5); /* Header light blue */
        color: #fff9e6; /* Bright text */
        padding: 15px; 
        text-align: left; 
        font-size: 15px;
        font-weight: 700;
    }
    .s-table td { padding: 12px 15px; border-bottom: 1px solid #ffe082; }
    .s-table tr:hover { background: #fff8e1; }

    /* FOOTER */
    .s-footer { 
        background: linear-gradient(135deg, #ffb400 0%, #3a6ea5 50%, #2a5a9a 100%); 
        color: white; text-align: center; padding: 20px; margin-top: 40px; 
        border-radius: 12px; font-weight: 500;
    }

    .s-alert-success { color: #2a5a9a; background: #fff8e1; padding: 12px; border-radius: 6px; margin-bottom: 15px; border-left: 4px solid #ffb400; }
    .s-alert-error { color: #b71c1c; background: #ffebee; padding: 12px; border-radius: 6px; margin-bottom: 15px; border-left: 4px solid #c62828; }
</style>
<div class="s-container">

    <!-- University Header -->
    <div class="s-header">
        <img src="https://www.pdn.ac.lk/assets/logo-Dx2RUCSi.png" alt="University Logo">
        <h1>University of Peradeniya</h1>
        <h2>Alumni Association</h2>
    </div>

    <!-- Form -->
    <div class="s-form">
        <h2 style="margin-top:0; color:#1a3a6e;">Alumni Registration Form</h2>

        <?php if($s_error) echo '<div class="s-alert-error">'.$s_error.'</div>'; ?>
        <?php if($s_success) echo '<div class="s-alert-success">'.$s_success.'</div>'; ?>

        <form method="post">
            <p>
                <label>Full Name</label>
                <input type="text" name="s_name" required>
            </p>
            <p>
                <label>Email</label>
                <input type="email" name="s_email" required>
            </p>
            <p>
                <label>Graduation Year</label>
                <input type="number" name="s_graduation_year" required>
            </p>
            <p>
                <input type="submit" name="s_submit_alumni" value="Submit Details" class="s-btn">
            </p>
        </form>
    </div>

    <!-- Table -->
    <h2 style="color:#1a3a6e;">Alumni Records</h2>
    <table class="s-table">
        <thead>
            <tr><th>ID</th><th>Full Name</th><th>Email</th><th>Graduation Year</th></tr>
        </thead>
        <tbody>
            <?php 
            if($s_results) {
                foreach($s_results as $s_row) {
                    echo '<tr><td>'.$s_row->id.'</td><td>'.$s_row->full_name.'</td><td>'.$s_row->email.'</td><td>'.$s_row->graduation_year.'</td></tr>';
                }
            } else {
                echo '<tr><td colspan="4" style="text-align:center; padding:20px;">No records found yet.</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="s-footer">
        <p>© 2026 University of Peradeniya Alumni Association | All Rights Reserved</p>
    </div>

</div>

<?php get_footer(); ?>