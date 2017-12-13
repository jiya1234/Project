var mongoose = require('mongoose');
var bcrypt = require('bcryptjs');

// User Schema
var ReservationSchema = mongoose.Schema({
	guestname: {
		type: String,
		index:true
	},
	password: {
		type: String
	},
	paidamout: {
		type: String
	},
	postal: {
		type: number
    },
    phone: {
        type:number;
    }
});