import { Users, UserPlus, Bike, Star, Calendar } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

const MembersSection = () => {
  const memberStats = [
    { label: "Total Members", value: "150+", icon: Users },
    { label: "Active This Month", value: "125", icon: Calendar },
    { label: "Years Active", value: "4+", icon: Star },
    { label: "Benelli Models", value: "8", icon: Bike }
  ];

  const featuredMembers = [
    {
      id: 1,
      name: "Ahmad Rizki",
      role: "President",
      bike: "Benelli TNT 600i",
      joinDate: "Founding Member",
      image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face",
      bio: "Passionate rider and leader, organizing rides since 2020"
    },
    {
      id: 2,
      name: "Budi Santoso",
      role: "Vice President",
      bike: "Benelli Leoncino 500",
      joinDate: "March 2020",
      image: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop&crop=face",
      bio: "Safety advocate and experienced touring enthusiast"
    },
    {
      id: 3,
      name: "Diana Putri",
      role: "Secretary",
      bike: "Benelli TRK 502X",
      joinDate: "May 2020",
      image: "https://images.unsplash.com/photo-1494790108755-2616b612b1e5?w=200&h=200&fit=crop&crop=face",
      bio: "Event coordinator and community relationship manager"
    },
    {
      id: 4,
      name: "Eko Prasetyo",
      role: "Treasurer",
      bike: "Benelli TNT 250",
      joinDate: "June 2020",
      image: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop&crop=face",
      bio: "Financial management and charity event organizer"
    },
    {
      id: 5,
      name: "Sari Dewi",
      role: "Road Captain",
      bike: "Benelli Imperiale 400",
      joinDate: "August 2020",
      image: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop&crop=face",
      bio: "Route planning expert and safety instructor"
    },
    {
      id: 6,
      name: "Rudi Hartono",
      role: "Event Manager",
      bike: "Benelli TNT 600 GT",
      joinDate: "January 2021",
      image: "https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=200&h=200&fit=crop&crop=face",
      bio: "Creative event planning and media documentation"
    },
    {
      id: 7,
      name: "Lisa Maharani",
      role: "Media Coordinator",
      bike: "Benelli Motobi 200 Evo",
      joinDate: "March 2021",
      image: "https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=200&h=200&fit=crop&crop=face",
      bio: "Social media management and photography"
    },
    {
      id: 8,
      name: "Doni Setiawan",
      role: "Technical Advisor",
      bike: "Benelli TNT 135",
      joinDate: "September 2021",
      image: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=200&h=200&fit=crop&crop=face",
      bio: "Motorcycle maintenance expert and workshop leader"
    }
  ];

  return (
    <section id="members" className="py-20 bg-muted/30">
      <div className="container mx-auto px-4">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="section-title mb-6">OUR BROTHERHOOD</h2>
          <p className="text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
            Meet the passionate riders who make BOI Bekasi a true family. 
            United by our love for Benelli motorcycles and the open road.
          </p>
        </div>

        {/* Member Statistics */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
          {memberStats.map((stat, index) => (
            <Card key={index} className="biker-card text-center">
              <CardContent className="p-6">
                <stat.icon className="w-8 h-8 text-primary mx-auto mb-3" />
                <div className="text-2xl font-bold text-foreground mb-1">{stat.value}</div>
                <div className="text-sm text-muted-foreground">{stat.label}</div>
              </CardContent>
            </Card>
          ))}
        </div>

        {/* Featured Members */}
        <div className="mb-12">
          <h3 className="text-3xl font-bold text-foreground mb-8 aggressive-border">
            Leadership & Active Members
          </h3>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {featuredMembers.map((member) => (
              <Card key={member.id} className="biker-card group hover:scale-105 transition-all duration-300">
                <CardContent className="p-6 text-center">
                  {/* Profile Image */}
                  <div className="relative mb-4">
                    <img
                      src={member.image}
                      alt={member.name}
                      className="w-20 h-20 rounded-full mx-auto object-cover border-2 border-primary/20"
                    />
                    <div className="absolute -bottom-1 -right-1 w-6 h-6 bg-primary rounded-full flex items-center justify-center">
                      <Bike className="w-3 h-3 text-primary-foreground" />
                    </div>
                  </div>

                  {/* Member Info */}
                  <h4 className="text-lg font-bold text-foreground mb-1 group-hover:text-primary transition-colors">
                    {member.name}
                  </h4>
                  
                  <Badge className="bg-primary/20 text-primary mb-3">
                    {member.role}
                  </Badge>

                  <div className="space-y-2 text-sm text-muted-foreground">
                    <div className="flex items-center justify-center space-x-2">
                      <Bike className="w-4 h-4 text-primary" />
                      <span>{member.bike}</span>
                    </div>
                    <div className="flex items-center justify-center space-x-2">
                      <Calendar className="w-4 h-4 text-primary" />
                      <span>{member.joinDate}</span>
                    </div>
                  </div>

                  <p className="text-xs text-muted-foreground mt-3 leading-relaxed">
                    {member.bio}
                  </p>
                </CardContent>
              </Card>
            ))}
          </div>
        </div>

        {/* Membership Benefits */}
        <div className="grid lg:grid-cols-2 gap-8 items-center mb-12">
          <Card className="biker-card">
            <CardContent className="p-8">
              <h3 className="text-2xl font-bold text-foreground mb-6">Membership Benefits</h3>
              <ul className="space-y-4">
                <li className="flex items-start space-x-3">
                  <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0" />
                  <div>
                    <span className="font-medium text-foreground">Exclusive Group Rides</span>
                    <p className="text-sm text-muted-foreground">Join weekly and monthly rides to scenic destinations</p>
                  </div>
                </li>
                <li className="flex items-start space-x-3">
                  <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0" />
                  <div>
                    <span className="font-medium text-foreground">Technical Workshops</span>
                    <p className="text-sm text-muted-foreground">Learn motorcycle maintenance and safety from experts</p>
                  </div>
                </li>
                <li className="flex items-start space-x-3">
                  <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0" />
                  <div>
                    <span className="font-medium text-foreground">Brotherhood Network</span>
                    <p className="text-sm text-muted-foreground">Connect with riders across Indonesia and beyond</p>
                  </div>
                </li>
                <li className="flex items-start space-x-3">
                  <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0" />
                  <div>
                    <span className="font-medium text-foreground">Event Discounts</span>
                    <p className="text-sm text-muted-foreground">Special rates for tours, accommodations, and gear</p>
                  </div>
                </li>
              </ul>
            </CardContent>
          </Card>

          {/* Join CTA */}
          <Card className="biker-card">
            <CardContent className="p-8 text-center">
              <UserPlus className="w-16 h-16 text-primary mx-auto mb-6" />
              <h3 className="text-2xl font-bold text-foreground mb-4">Ready to Join?</h3>
              <p className="text-muted-foreground mb-6 leading-relaxed">
                Become part of the most respected Benelli community in Bekasi. 
                Experience the true meaning of motorcycle brotherhood.
              </p>
              
              <div className="space-y-4">
                <Button size="lg" className="w-full hero-button">
                  Apply for Membership
                </Button>
                <Button variant="outline" size="lg" className="w-full border-primary/30 hover:bg-primary/10">
                  Download Membership Guide
                </Button>
              </div>

              <div className="mt-6 pt-6 border-t border-border">
                <p className="text-sm text-muted-foreground">
                  <span className="font-medium text-foreground">Requirements:</span><br />
                  Own a Benelli motorcycle, valid driving license, commitment to safety
                </p>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </section>
  );
};

export default MembersSection;