<?php
    while ($row = mysqli_fetch_assoc($sql)) {
        // start
        // let's show the last msg  in users list where image and name are shown
        $sql2 = "SELECT *FROM messages WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} OR outgoing_msg_id = {$row['unique_id']}) ORDER BY msg_id DESC LIMIT 1";
        // end
        $query2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0){
            $result = $row2['msg'];
        } else{
            $result = "No message available.";
        }

        // trimming msg if word are more than 28 
        (strlen($result) > 24) ? $msg = substr($result,0,24).'...' : $msg = $result;

        // adding text before msg if login id send msg
        // it is required to check that $row2 is not null but the index 'outgoing_msg_id' does not exist. (stack overflow)
        $you = isset($row2['outgoing_msg_id']) ? (($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "") : "";

        // check user is online or offline
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

        $output .= '<a href="chat.php?user_id='. $row['unique_id'].'">
                    <div class="content">
                    <img src="php/profiles/'. $row['profile']. '" alt="">
                    <div class="details">
                        <span>'. $row['fname']. ' '. $row['lname']. '<span>
                        <p>'.$you . $msg.' </p>
                    </div>
                    </div>
                    <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                    </a>
                   ';
    }
?>