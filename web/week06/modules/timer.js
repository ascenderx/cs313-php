function isSet(val) {
    return (val !== undefined && val !== null);
}

class Timer {
    constructor(params) {
        this.id = null;
        this.elapsed = null;
        this.time = null;
        this.begin = null;
        this.limit = null;
        this.finishFunc = null;
        
        if (!params) {
            return;
        }

        for (let key in params) {
            let value = params[key];
            switch (key) {
                case 'limitMillis':
                case 'limit':
                    this.setLimitMillis(value);
                    break;
                case 'limitSeconds':
                    this.setLimitSeconds(value);
                    break;
                case 'finishFunc':
                case 'finish':
                    this.setFinishFunc(value);
                    break;
                default:
                    throw `Unknown timer param "${key}"`;
            }
        }
    }

    setFinishFunc(func) {
        this.finishFunc = func;
    }

    getLimitSeconds() {
        return Math.floor(this.limit / 1000);
    }

    getLimitMillis() {
        return this.limit;
    }
    
    setLimitSeconds(seconds) {
        if (isNaN(seconds)) {
            throw 'Invalid time in seconds';
        }
        this.limit = parseInt(seconds) * 1000;
    }

    setLimitMillis(millis) {
        if (isNaN(millis)) {
            throw 'Invalid time in milliseconds';
        }
        this.limit = parseInt(millis);
    }

    getTimeSeconds() {
        return Math.floor(this.time / 1000);
    }

    getTimeMillis() {
        return this.time;
    }

    tick() {
        if (!isSet(this.id)) {
            return;
        }

        let now = new Date().valueOf();
        this.time = now - this.begin;

        if (this.limit && (this.elapsed + this.time >= this.limit)) {
            this.stop();
            if (this.finishFunc) {
                this.finishFunc();
            }
        }
    }

    start() {
        if (this.elapsed || this.id) {
            return false;
        }

        this.elapsed = 0;
        this.begin = new Date().valueOf();
        this.id = setInterval(this.tick.bind(this), 200);

        return true;
    }

    pause() {
        if (!isSet(this.id)) {
            return null;
        }

        clearInterval(this.id);
        this.elapsed += this.time;
        this.begin = null;
        this.id = null;
        this.time = null;

        return this.elapsed;
    }

    resume() {
        if (!this.elapsed || this.id) {
            return false;
        }

        this.begin = new Date().valueOf();
        this.id = setInterval(this.tick.bind(this), 200);

        return true;
    }

    stop() {
        if (!isSet(this.id) && !isSet(this.elapsed)) {
            return null;
        }

        if (isSet(this.id)) {
            clearInterval(this.id);
        }
        
        let total = this.elapsed + this.time;
        this.elapsed = null;
        this.begin = null;
        this.id = null;
        this.time = null;

        return total;
    }

    isRunning() {
        return isSet(this.id);
    }

    isPaused() {
        return !isSet(this.id) && isSet(this.elapsed);
    }
}
