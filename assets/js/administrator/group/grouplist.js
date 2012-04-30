Ext.define('GroupData', {
  	extend: 'Ext.data.Model',
  	fields: [
  		{name: 'groupid', type: 'string'},
      	{name: 'groupname', type: 'string'},
 		{name: 'groupdesc', type: 'string'},
 		{name: 'total', type: 'number'},
 		{name: 'groupstatus', type: 'boolean'},
 		{name: 'issiteadmin', type: 'boolean'},
 		{name: 'isadmin', type: 'boolean'},
 		{name: 'isviewer', type: 'boolean'},
  	],
});

Ext.define('App.Inventory.SiteAdmin.GroupListPanel', {
	requires: [
		'Ext.data.*',
		'Ext.grid.Panel',
		'Ext.toolbar.Paging'
	],
	
    extend: 'Ext.grid.Panel',
    alias: 'widget.siteadmin-grouplistpanel',
	
	selModel: Ext.create("Ext.selection.CheckboxModel"),
	
    columns: [{
    	dataIndex: 'groupname',
       	id: 'groupname',
       	header: 'Group Name',
       	sortable: true,
       	flex: 0.50,
       	editor: {
			allowBlank: false,
           	selectOnFocus: true,
      	},
    }, {
       	dataIndex: 'total',
       	id: 'total',
       	header: 'Total Member',
       	sortable: true,
       	align: 'center',
       	flex: 0.19,
   	}, {
        	dataIndex: 'groupdesc',
        	id: 'groupdesc',
        	header: 'Description',
        	sortable: true,
        	flex: 1,
        	editor: {
        		selectOnfocus: true,
        	},
    	}, {
    		xtype: 'booleancolumn',
        	dataIndex: 'groupstatus',
        	id: 'groupstatus',
        	header: 'Group Status',
        	trueText: 'Active',
        	falseText: 'Inactive',
        	sortable: true,
        	align: 'center',
        	flex: 0.17,
   		editor: {
           	xtype: 'checkbox',
           	cls: 'x-grid-checkheader-editor'
     	},
    	}, {
    		xtype: 'booleancolumn',
        	dataIndex: 'issiteadmin',
        	id: 'issiteadmin', 
        	header: 'Site Admin Privilege', 
        	trueText: 'Yes',
        	falseText: 'No',
        	sortable: true,
        	align: 'center',
        	flex: 0.25,
        	editor: {
           	xtype: 'checkbox',
           	cls: 'x-grid-checkheader-editor'
     	},
    	}, {
    		xtype: 'booleancolumn',
        	dataIndex: 'isadmin',
        	id: 'isadmin',
        	header: 'Admin Privilege',
        	trueText: 'Yes',
        	falseText: 'No', 
        	sortable: true,
        	align: 'center',
        	flex: 0.20,
        	editor: {
           	xtype: 'checkbox',
           	cls: 'x-grid-checkheader-editor'
     	},
    	}, {
    		xtype: 'booleancolumn',
        	dataIndex: 'isviewer',
        	id: 'isviewer',
        	header: 'Site View Privilege',
        	trueText: 'Yes',
        	falseText: 'No',
        	sortable: true,
        	align: 'center',
        	flex: 0.22,
        	editor: {
           	xtype: 'checkbox',
           	cls: 'x-grid-checkheader-editor'
     	},
    	}],
    	
    	viewConfig: {
    		forceFit: true,
    		emptyText: 'No record found',
    	},
    
    	initComponent: function() {
    		this.store = Ext.create('Ext.data.Store', {
			pageSize: 50,
			model: 'GroupData',
			remoteSort: true,
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: group_list_url,
		 		reader: {
		            	type: 'json',
		            	root: 'data',
		            	totalProperty: 'total'
		        	}
	       	},
	       	autoLoad: true,
	       	autoDestroy: true,
	   	});
	   	
	   	this.dockedItems = [{
	    		xtype: 'toolbar',
	    		items: [{
		    		text: 'Add Group',
		  			iconCls: 'add',
		  			scope: this,
		  			handler: this.onAddGroupClick,
		    	}, '-', {
		    		text: 'Delete Group',
		  			iconCls: 'remove',
		  			scope: this,
		  			handler: this.onDelGroupClick,
		    	}, '-', {
		    		text: 'Edit Group',
		  			iconCls: 'edit',
		    	}]
	    	}];
	   	
	   	this.bbar = Ext.create('Ext.PagingToolbar', {
            	store: this.store,
            	displayInfo: true,
            	displayMsg: 'Displaying {0} - {1} of {2}',
            	emptyMsg: "No items to display",
        	});
	   	
	   	var editor = Ext.create('Ext.grid.plugin.RowEditing', {
			clicksToMoveEditor: 1,
	        	autoCancel: false
	    	});
	   	
	   	this.plugins = [ editor ];
	   	
    		this.callParent(arguments);
    		this.isNew = false;
    		this.editor = editor;
    	},
    	
    onAddGroupClick: function() {
		this.isNew = true;
		var g = Ext.ModelManager.create({
				groupname: 'new group name',
				total: '0',
				groupstatus: false,
				issiteadmin: false,
				isadmin: false,
				isviewer: false,
				groupdesc: 'new group description',
	    	}, 'GroupData');
	    	this.editor.cancelEdit();
	    	this.store.insert(0, g);
	    	this.getSelectionModel().select(0);
    		this.editor.startEdit(0, 0);
    	},
    	
    	onDelGroupClick: function() {
    		var sel = this.getSelectionModel();
	    	if (sel.hasSelection()) {
      		Ext.Msg.show({
				title: 'Delete Confirmation Form',
				msg: 'Delete Selected Group(s) ?',
				icon: Ext.MessageBox.QUESTION,
				buttons: Ext.Msg.YESNO,
				fn: function(btn) {
			    		if (btn == 'yes') {
						var sm = this.grouplist_grid.getSelectionModel();
						var sel = sm.getSelections();
						var data = '';
						for (i = 0; i<sel.length; i++) {
							if (data.length > 0) {
								data = data + ';';
							}
				    			data = data + sel[i].get('gid');
						}
						Ext.Ajax.request({
				    			url: group_del_url,
							method: 'POST',
	            				params: { ids: data },
	            				success: this.onSuccessSubmit,
	      					failure: this.onFailedSubmit,
	      					callback: function() {
	      						this.reloadGrid();
	      					},
	      					scope: this,
	  					});
		        		}
		    		},
		    		scope: this
			});
	    	} else {
			var masg = 'Please select a group before continue';
	    	}
    	},
    	
    	onEditGroupClick: function() {
    		var sel = this.getSelectionModel();
	    	if (sel.hasSelection()) {
	    		
	    	} else {
	    		var masg = 'Please select a group before continue';
	    	}
    	},
    	
    	onAfterEdit: function() {
    		return 0;
    	}
});