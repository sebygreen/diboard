export default async function getPosts(callback) {
    await fetch("/posts")
        .then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error("Bad Server Response! Response: " + response.status);
            }
        })
        .then((data) => {
            callback(data);
            return data;
        })
        .catch((error) => {
            console.error("ERROR: Failed to get posts...");
            return error;
        });
}
