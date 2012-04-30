Ext.define('App.Monitoring.Dashboard.CpuData.CpuUsage', {
    	extend: 'Ext.panel.Panel',
    	alias : 'widget.cpudata-cpuusage',
    	id: 'db-cpu-usage',

    	tpl: [ 
    		'<table width="100%" height="100%">',
    			'<tr>',
    				'<td align="center" bgcolor="{usagecolor}"><b><font size="30em">{cpuusage}</font></b></td>',
    			'</tr>',
		'</table>'
    	],
	//html: '<table width="100%" height="100%"><tr><td align="center"><b><font size="30em"> </font></b></td></tr></table>',
    
    	loadRecord: function(cpuusage) {
    		var usagecolor = null;
    		if (cpuusage >= 80 && cpuusage < 90) {
    			usagecolor = 'yellow';
    		} else if (cpuusage >= 90) {
    			usagecolor = 'red';
    		} else {
    			usagecolor = 'white';
    		}
    		
    		var usagedata = {
    			usagecol: usagecolor,
    			cpuusage: cpuusage,
    		};
    		
    		//var usagetpl = Ext.create('Ext.XTemplate','<table width="100%" height="100%"><tr><td align="center" bgcolor="{usagecolor}"><b><font size="30em">{cpuusage}</font></b></td></tr></table>');
    		//usagetpl.overwrite(this.body, usagedata);
    		//this.highlight('#c3daf9', {block:true});
        	this.tpl.overwrite(this.body, usagedata);
        	this.highlight('#c3daf9', {block:true});
    	}
});