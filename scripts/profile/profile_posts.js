var userId;
function sortPosts() {
    addPosts(true);
}

function getId() {
    var name = 'id';
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function id() {
    userId = getId();
    console.log('ID PASSED:     ' + userId);
}

var lastId = 0;
var lastPostId = 0;
function addPosts(initial, id) {
    /*
    var temp = document.getElementsByTagName("template")[0];
    var clon = temp.content.cloneNode(true);
    var fragment = clon.content;
    document.body.appendChild(clon);
    */
    
    postData = getPostNew(initial, id);
    
    if (postData == false) {
        return false;
    }
    
    var parsedPostData = JSON.parse(postData);
    lastId = Object.keys(parsedPostData).length;
    for (var i = 0; i < lastId; i++) {
        if ('content' in document.createElement('template')) {
            var body = document.querySelector('body');
            var template = document.querySelector('template');

            var clone = template.content.cloneNode(true);

            body.appendChild(clone);

            var posterName = parsedPostData[i].posterName;
            var postCaption = parsedPostData[i].content;
            var postDate = parsedPostData[i].timestamp;
            postCaption = postCaption.replace(/(?:\r\n|\r|\n)/g, '<br>');

            console.log('Itiration number: ' + i + ', ' + 'Poster Name: ' + posterName + ', ID=' + parsedPostData[i].id);

            document.getElementById("screenName").textContent = posterName;
            document.getElementById("content").innerHTML = postCaption;            
            document.getElementById("postDate").textContent = postDate;
            document.getElementById("profilePhotoPost").setAttribute('src', '/userData/' + userId + '/profilePhoto/def.jpg');

            document.getElementById("screenName").id = 'name' + i;
            document.getElementById("content").id = 'content' + i;
            document.getElementById("postDate").id = 'postDate' + i;
            document.getElementById("profilePhotoPost").id = 'profilePhotoPost' + i;

            document.getElementById("contentLink").id = 'contentLink' + i;
            document.getElementById("userLink").id = 'userLink' + i;

            document.getElementById("post").classList.add('post' + parsedPostData[i].id);
            document.getElementById("post").id = 'post' + parsedPostData[i].id;

            document.getElementById("contentLink" + i).setAttribute('href', 'posts/post/post.php?postId=' + parsedPostData[i].id);
            document.getElementById("userLink" + i).setAttribute('href', 'userProfile.php?reqID=' + parsedPostData[i].posterId);
        } else {

        }
    }
    // pageEnd();
    lastPostId = parsedPostData[parsedPostData.length - 1].id;
    lastId = parsedPostData[parsedPostData.length - 1].id;
    console.log(postData);
}

function pageEnd() {
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
            // alert("you're at the bottom of the page");
            //getPostNew(lastPostId);
            //console.log(decodeURIComponent(getPosts()));
            addPosts(false, lastId);
        }
    };
}

function getPostNew(initial, id) {
    var output = false;
    var executionReady = false;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // output = this.responseText;
            // var b = document.getElementById('theOutput');
            // b.innerHTML = output + '<br> <br>';
            // return output;
        }
    };
    if (initial) {
        xhttp.open("GET", "http://localhost/app/posts/profile/requestPostsProfile.php?reqId=na&authorId=" + userId, false);
        executionReady = true;
    } else if (id > 3) {
        xhttp.open("GET", "http://localhost/app/posts/requestPosts/requestPosts.php?reqId=" + id + "&authorId=" + userId, false);
        executionReady = true;
    } else {
        executionReady = false;
    }
    if(executionReady) {
        xhttp.send();
        output = xhttp.responseText;
        console.log(id);
    }
    return output;
}