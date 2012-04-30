Ext.define('App.Inventory.NavigationTree', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.inventory-navigationtree',
    
    region: 'west',
    title: 'Site Navigation',
    width: 200,
    split: true,
    collapsible: true,
    xtype: 'treepanel',
    rootVisible: false,
    
    listeners: {
        'itemclick': function(view, model) {
            this.fireEvent('navclick', this, model.data.id);
        }
    },
    
    initComponent: function() {
        Ext.define('NavLink', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'id', type: 'string'},
                {name: 'text', type: 'string'}
            ],
        });
        
        this.store = Ext.create('Ext.data.TreeStore', {
            model: 'NavLink',
            root: {
                expanded: true
            },
            proxy: {
                type: 'ajax',
                actionMethod: 'POST',
                url: nav_url,
            }
        });
        
        this.callParent(arguments);
        this.addEvents('navclick');
    }
});