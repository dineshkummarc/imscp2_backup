# i-MSCP - internet Multi Server Control Panel
# Copyright (C) 2010 by internet Multi Server Control Panel
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
#
# @category		i-MSCP
# @copyright	2010 - 2011 by i-MSCP | http://i-mscp.net
# @author		Daniel Andreca <sci2tech@gmail.com>
# @version		SVN: $Id$
# @link			http://i-mscp.net i-MSCP Home Site
# @license      http://www.gnu.org/licenses/gpl-2.0.html GPL v2

package Common::SingletonClass;

use strict;
use warnings;
use Symbol;

my $instance = undef;

sub new {
	my $proto	= shift;
	my $class	= ref($proto) || $proto;
	my $x= qualify_to_ref('_instance', $class);

	return ${*$x} unless ! ${*$x};

	my $self = {
		'errors'	=> [],
		'args'		=> {@_} || {}
	};

	bless($self, $class);

	${*$x} = $self;

	if($self->can('_init')){ $self->_init();}

	return($self);
}

1;

__END__
