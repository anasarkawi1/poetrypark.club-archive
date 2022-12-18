function getId() {
    var name = 'id';
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function likePost(postId) {
    requestActionLike(postId, getId(), true);
    console.log("like function set");
}

function dislikePost(postId) {
    requestActionLike(postId, getId(), false);
    console.log("dislike function set");
}

function requestActionLike(postId, viewerId, like) {
    var output = false;
    var executionReady = false;
    var likeButton = document.getElementById("likeButton" + postId);
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
    };
    
    if (like) {
        var url = "http://localhost/app/posts/action/likeActions/postActionLike.php?like=true&postId=" + postId + "&viewerId=" + viewerId;
        xhttp.open("POST", url, false);
        likeButton.setAttribute("onclick", "dislikePost(" + postId + ")");
        likeButton.innerHTML = "Dislike";
        executionReady = true;
    } else if (like == false) {
        var url = "http://localhost/app/posts/action/likeActions/postActionLike.php?like=0&postId=" + postId + "&viewerId=" + viewerId;
        xhttp.open("POST", url, false);
        likeButton.setAttribute("onclick", "likePost(" + postId + ")");
        likeButton.innerHTML = "Like";
        executionReady = true;
    } else {
        executionReady = false;
    }
    
    if(executionReady == true) {
        xhttp.send();
        output = xhttp.responseText;
    }
    
    setLikeStatus(postId, like);
    
    return output;
}

function setLikeStatus(postId, likeStat) {
    if (likeStat) {
        // Change label to "Dislike"
        console.log("POST ID=" + postId + "\n POST STATS=LIKED");
    } 
    else if (!likeStat) {
        // Change label to "Like"
        console.log("POST ID=" + postId + "\n POST STATS=DISLIKED");
    }
}