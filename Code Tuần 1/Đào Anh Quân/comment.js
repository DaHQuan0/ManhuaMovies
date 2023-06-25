// Lấy các phần tử DOM cần sử dụng
const commentForm = document.getElementById("comment-form");
const commentInput = document.getElementById("comment-input");
const commentList = document.getElementById("comment-list");
const sortSelect = document.getElementById("sort-select");

// Biến lưu trữ danh sách bình luận
let comments = [];

// Hàm tạo phần tử bình luận
function createCommentElement(comment) {
  const commentItem = document.createElement("div");
  commentItem.classList.add("comment-container");

  // Tạo đối tượng Date từ chuỗi thời gian của bình luận
  const timestamp = new Date(comment.timestamp);
  const timestampString = timestamp.toLocaleString();

  commentItem.innerHTML = `
    <div class="comment-info">
        <img class="avatar" src="avatar.jpg" alt="Avatar">
        <div>
            <span class="username">${comment.username}</span>
            <span>${timestampString}</span>
        </div>
    </div>
    <div class="comment-text">${comment.text}</div>
    <div class="interactions">
        <button class="like-button">Like</button>
        <button class="dislike-button">Dislike</button>
        <button class="reply-button">Reply</button>
        <span class="likes-count">${comment.likes} Likes</span>
        <span class="dislikes-count">${comment.dislikes} Dislikes</span>
    </div>
    <div class="reply-form">
        <input type="text" placeholder="Write a reply..." class="reply-input">
        <button class="reply-submit-button">Submit</button>
    </div>
  `;

  return commentItem;
}

// Hàm hiển thị danh sách bình luận
function renderComments() {
  commentList.innerHTML = "";

  comments.forEach(comment => {
    const commentItem = createCommentElement(comment);
    commentList.appendChild(commentItem);
  });
}

// Hàm xử lý sự kiện khi gửi bình luận
function handleCommentSubmit(event) {
  event.preventDefault();

  const commentText = commentInput.value;
  const comment = {
    username: "John Doe",
    timestamp: Date.now(),
    text: commentText,
    likes: 0,
    dislikes: 0
  };

  comments.push(comment);
  renderComments();
  commentInput.value = "";
  sortComments(sortSelect.value);
}

// Hàm sắp xếp danh sách bình luận
function sortComments(option) {
  if (option === "oldest") {
    comments.sort((a, b) => a.timestamp - b.timestamp);
  } else if (option === "newest") {
    comments.sort((a, b) => b.timestamp - a.timestamp);
  } else if (option === "most-liked") {
    comments.sort((a, b) => b.likes - a.likes);
  }

  renderComments();
}

// Sự kiện khi thay đổi giá trị của select
sortSelect.addEventListener("change", function(event) {
  const selectedOption = event.target.value;
  sortComments(selectedOption);
});

// Sự kiện khi nhấp vào nút "Reply"
commentList.addEventListener("click", function(event) {
  if (event.target.classList.contains("reply-button")) {
    const replyContainer = event.target.parentNode.nextElementSibling;
    replyContainer.classList.toggle("show-reply-form");
  }
});

// Sự kiện khi nhấp vào nút "Like"
commentList.addEventListener("click", function(event) {
  if (event.target.classList.contains("like-button")) {
    const likesCount = event.target.parentNode.querySelector(".likes-count");
    let likes = parseInt(likesCount.textContent);
    likes++;
    likesCount.textContent = `${likes} Likes`;
  }
});

// Sự kiện khi nhấp vào nút "Dislike"
commentList.addEventListener("click", function(event) {
  if (event.target.classList.contains("dislike-button")) {
    const dislikesCount = event.target.parentNode.querySelector(".dislikes-count");
    let dislikes = parseInt(dislikesCount.textContent);
    dislikes++;
    dislikesCount.textContent = `${dislikes} Dislikes`;
  }
});

// Sự kiện khi nhấp vào nút "Submit" trong phần trả lời
commentList.addEventListener("click", function(event) {
  if (event.target.classList.contains("reply-submit-button")) {
    const replyInput = event.target.parentNode.querySelector(".reply-input");
    const replyText = replyInput.value;

    const replyItem = createCommentElement({
      username: "Jane Smith",
      timestamp: Date.now(),
      text: replyText,
      likes: 0,
      dislikes: 0
    });

    const replyContainer = event.target.parentNode.parentNode;
    replyContainer.appendChild(replyItem);
    replyInput.value = "";
  }
});

// Gán sự kiện submit cho form
commentForm.addEventListener("submit", handleCommentSubmit);
