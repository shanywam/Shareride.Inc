<?php

$ride = 0;
function getUserRides($user_id)
{
    global $ride;
    global $logged_user;

    $ride = $logged_user->countUserRides($user_id);

    if ($ride == 0) {
        echo "None";
    } else {
        echo $ride . " ride (s)";
    }
}

$user_type = 2;

$client_data = $logged_user->getUsersByType($user_type);

?>

<div>
    <h1>Clients Section</h1>

    <div>
        <h3>Clients/ride List</h3>


        <br>

        <p style="color: green"></p>
            <?php
            //echo $delete_message;
            ?>

        <div>
            <table style="width:100%">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($clients_data as $array) { ?>
                    <tr>
                        <td class=""><?php echo $array['firstname'] . ' ' . $array['lastname']; ?></td>
                        <td class=""><?php echo $array['email']; ?></td>
                        <td class=""><?php echo $array['phone']; ?></td>
                        //<td class=""><?php getUserEventsCount($array['id']); ?></td>
                        <td class=" action-btns">
                            <form action="../driver/drive.php" method="post">
                                <input type="hidden" name="delete_client" value="show_panel">

                                <input type="hidden" name="user_id" value="<?php echo $array['id']; ?>">

                                <button class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php }; ?>

            </table>

        </div>

        <br>

        <?php if ($delete_panel) { ?>
            <div>
                <form id="edit_form" action="drive.php" method="post">
                    <h3>Delete Details</h3>

                    <h4 style="color: red;">Are you sure you want to delete clients account details</h4>

                    <p>Name: <?php echo $user_details['firstname'] . ' ' . $user_details['lastname'] ?></p>
                    <p>Email: <?php echo $user_details['email']; ?></p>
                    <p>Phone: <?php echo $user_details['phone']; ?></p>

                    <div class="edit-form-group">

                        <form action="drive.php" method="post" style="float: left;width: 50%;">
                            <input type="hidden" name="delete_client" value="cancel_delete">

                            <button name="submit" type="submit" id="contact-submit" class="cancel_form_btn"
                                    data-submit="...Sending">NO
                            </button>
                        </form>

                        <form action="drive.php" method="post" style="float: left;width: 50%;">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            <input type="hidden" name="delete_client" value="delete_client">

                            <button name="submit" type="submit" id="contact-submit" class="delete_form_btn"
                                    data-submit="...Sending">YES
                            </button>
                        </form>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
