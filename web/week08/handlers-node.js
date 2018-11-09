module.exports = {
    /**
     * HANDLE -> HOME
     * Returns the homepage.
     * @returns A simple reply object (status, HTTP header, and content)
     */
    home: function() {
        return {
            status: 200,
            header: {
                'Content-Type': 'text/html'
            },
            content: '<h1>Welcome to the Home Page</h1>'
        };
    },

    /**
     * HANDLE -> SIMPLE DATA
     * Returns some simple JSON data.
     * @returns A simple reply object (status, HTTP header, and content)
     */
    simpleData: function() {
        let data = {
            'name': 'Jimmy Downer',
            'class': 'cs313'
        };

        return {
            status: 200,
            header: {
                'Content-Type': 'application/json' 
            },
            content: JSON.stringify(data)
        };
    },

    /**
     * GO TO GITHUB.IO
     */
    goGithubIO: function() {
        return {
            status: 301,
            header: {
                'Location': 'https://ascenderx.github.io'
            },
            content: null
        };
    },

    /**
     * HANDLE -> NOT FOUND
     * Sends a simple 404 page.
     * @returns A simple reply object (status, HTTP header, and content)
     */
    notFound: function() {
        return {
            status: 404,
            header: {
                'Content-Type': 'text/html'
            },
            content: 'Page Not Found'
        };
    }
};