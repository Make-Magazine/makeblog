// Define our projects object
var Projects = {
	Models: {},
	Views: {},
	Collections: {}
};


// Models
///////////////////
Projects.Models.Single = Backbone.Model.extend({

	// Default attributes
	defaults: {
		project_title: '',
		project_img: '',
		project_url: ''
	}
});

// Collections
///////////////////
Projects.Collections = Backbone.Collection.extend({
	model: Projects.Models.Single
});

// Views
///////////////////

// This view will produce a singluar Project
Projects.Views.Single = Backbone.View.extend({
	
	tagName: 'article',
	className: 'projects',
	template: _.template( jQuery( '#projectTemp').html() ),

	render: function() {
		this.$el.html( this.template( this.model.toJSON() ) );

		return this;
	}
});

// This view will produc a grid of projects
Projects.Views.Latest = Backbone.View.extend({
	el: '#latest',

	initialize: function( projects ) {
		this.collection = new Projects.Collections( projects );

		this.render();
	},

	// Render each project stored in the collection
	render: function() {
		this.collection.each( function( project ) {
            this.add_project( project );
        }, this );
	},

	// Add a project by creating a project_view and appending the element it render to the parent element
	add_project: function( project ) {
		var latest_projects = new Projects.Views.Single({
			model: project
		});

		this.$el.append( latest_projects.render().el );
	}
});


// Run when the DOM is ready
jQuery( function()  {
	var list_projects = [
		{ project_title: 'My New Project', project_url: 'http://google.com', project_img: 'http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg' },
		{ project_title: 'My New Project', project_url: 'http://google.com', project_img: 'http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg' },
		{ project_title: 'My New Project', project_url: 'http://google.com', project_img: 'http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg' },
		{ project_title: 'My New Project', project_url: 'http://google.com', project_img: 'http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg' },
		{ project_title: 'My New Project', project_url: 'http://google.com', project_img: 'http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg' },
	];

	// Load the latest projects by default
	new Projects.Views.Latest( list_projects );
});