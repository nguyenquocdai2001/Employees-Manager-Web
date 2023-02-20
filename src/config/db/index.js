const mongoose = require('mongoose');

async function connect(){
    try {
        await mongoose.connect('mongodb://127.0.0.1:27017/education');
        console.log('Connect susscessfully!!!')
    } catch (error) {
        console.log('Connect failure!!!')
    }
}

module.exports = {connect};