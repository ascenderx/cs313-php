function isSet(val) {
    return (val !== undefined && val !== null);
}

function makeTimer() {
    let id = null;
    let elapsed = null;
    let time = null;
    let limit = null;
    let begin = null;
    let finishFunc = null;

    function setFinishFunc(func) {
        finishFunc = func;
    }

    function getLimitSeconds() {
        return Math.floor(limit / 1000);
    }

    function getLimitMillis() {
        return limit;
    }
    
    function setLimitSeconds(seconds) {
        if (isNaN(seconds)) {
            throw 'Invalid time in seconds';
        }
        limit = parseInt(seconds) * 1000;
    }

    function setLimitMillis(millis) {
        if (isNaN(millis)) {
            throw 'Invalid time in milliseconds';
        }
        limit = parseInt(millis);
    }

    function getTimeSeconds() {
        return Math.floor(time / 1000);
    }

    function getTimeMillis() {
        return time;
    }

    function tick() {
        if (!isSet(id)) {
            return;
        }

        let now = new Date().valueOf();
        time = now - begin;

        if (limit && (elapsed + time >= limit)) {
            stop();
            if (finishFunc) {
                finishFunc();
            }
        }
    }

    function start() {
        if (elapsed || id) {
            return false;
        }

        elapsed = 0;
        begin = new Date().valueOf();
        id = setInterval(tick, 200);

        return true;
    }

    function pause() {
        if (!isSet(id)) {
            return null;
        }

        clearInterval(id);
        elapsed += time;
        begin = null;
        id = null;
        time = null;

        return elapsed;
    }

    function resume() {
        if (!elapsed || id) {
            return false;
        }

        begin = new Date().valueOf();
        id = setInterval(tick, 200);

        return true;
    }

    function stop() {
        if (!isSet(id) && !isSet(elapsed)) {
            return null;
        }

        if (isSet(id)) {
            clearInterval(id);
        }
        
        let total = elapsed + time;
        elapsed = null;
        begin = null;
        id = null;
        time = null;

        return total;
    }

    function isRunning() {
        return isSet(id);
    }

    function isPaused() {
        return !isSet(id) && isSet(elapsed);
    }

    return {
        setFinishFunc: setFinishFunc,
        getLimitSeconds: getLimitSeconds,
        getLimitMillis: getLimitMillis,
        setLimitSeconds: setLimitSeconds,
        setLimitMillis: setLimitMillis,
        getTimeSeconds: getTimeSeconds,
        getTimeMillis: getTimeMillis,
        start: start,
        pause: pause,
        resume: resume,
        stop: stop,
        isRunning: isRunning,
        isPaused: isPaused,
    };
}