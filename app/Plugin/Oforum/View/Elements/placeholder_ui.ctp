<!-- Header -->
<header>
    <h1>Forum Web App</h1>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/threads">Threads</a></li>
            <!-- Add more navigation links here -->
        </ul>
    </nav>
</header>

<!-- Homepage -->
<div id="home">
    <h2>Welcome to the Forum</h2>
    <p>This is a placeholder for the homepage content.</p>
</div>

<!-- Thread List -->
<div id="thread-list">
    <h2>Threads</h2>
    <ul>
        <li>
            <h3><a href="/threads/1">Thread Title 1</a></h3>
            <p>Posted by User1 - 1 hour ago</p>
            <p>This is a placeholder for the thread description.</p>
        </li>
        <li>
            <h3><a href="/threads/2">Thread Title 2</a></h3>
            <p>Posted by User2 - 2 hours ago</p>
            <p>This is a placeholder for the thread description.</p>
        </li>
        <!-- Add more thread items here -->
    </ul>
</div>

<!-- Single Thread View -->
<div id="single-thread">
    <h2>Thread Title 1</h2>
    <p>Posted by User1 - 1 hour ago</p>
    <div id="thread-content">
        <p>This is a placeholder for the thread content.</p>
    </div>
    <!-- Add a form for posting replies here -->
</div>

<!-- Create Post Page -->
<div id="create-post">
    <h2>Create a New Post</h2>
    <form action="/create-post" method="post">
        <label for="post-title">Title:</label>
        <input type="text" id="post-title" name="post-title" placeholder="Enter the post title" required>

        <label for="post-content">Content:</label>
        <textarea id="post-content" name="post-content" placeholder="Enter the post content" required></textarea>

        <button type="submit">Create Post</button>
    </form>
</div>

<!-- Post Comment Page -->
<div id="post-comment">
    <h2>Post a Comment</h2>
    <form action="/post-comment" method="post">
        <label for="comment-content">Comment:</label>
        <textarea id="comment-content" name="comment-content" placeholder="Enter your comment" required></textarea>

        <button type="submit">Post Comment</button>
    </form>
</div>

<!-- Reply to Comment Page -->
<div id="reply-comment">
    <h2>Reply to Comment</h2>
    <form action="/reply-comment" method="post">
        <label for="reply-content">Reply:</label>
        <textarea id="reply-content" name="reply-content" placeholder="Enter your reply" required></textarea>

        <button type="submit">Reply</button>
    </form>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2023 Forum Web App</p>
</footer>