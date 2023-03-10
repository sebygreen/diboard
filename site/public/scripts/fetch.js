export async function getPosts(callback) {
    await fetch("/api/posts")
        .then((response) => {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error("Bad Server Response! Response: " + response.status);
            }
        })
        .then((data) => {
            callback(data);
            return data;
        })
        .catch((error) => {
            console.error("ERROR: Failed to get posts...", error);
            return error;
        });
}

export async function getPost(callback, uuid) {
    await fetch("/edit-post?uuid=" + uuid)
        .then((response) => {
            if (response.ok) {
                console.log(response.text());
                return response.text();
            } else {
                throw new Error("Bad server response. Response: " + response.status);
            }
        })
        .catch((error) => {
            console.error("Failed to get posts...", error);
            return error;
        });
}
