import { Calendar, MapPin, Users, Clock, ArrowRight } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

const EventsSection = () => {
  const upcomingEvents = [
    {
      id: 1,
      title: "Sunday Morning Ride",
      date: "2024-08-04",
      time: "06:00 AM",
      location: "Bekasi Square",
      participants: 25,
      description: "Weekly group ride to Puncak with breakfast stop",
      status: "open"
    },
    {
      id: 2,
      title: "Charity Ride for Education",
      date: "2024-08-10",
      time: "08:00 AM",
      location: "Alun-alun Bekasi",
      participants: 50,
      description: "Join us in supporting local education initiatives",
      status: "featured"
    },
    {
      id: 3,
      title: "Technical Workshop",
      date: "2024-08-15",
      time: "02:00 PM",
      location: "BOI Basecamp",
      participants: 30,
      description: "Motorcycle maintenance and safety workshop",
      status: "open"
    }
  ];

  const pastEvents = [
    {
      title: "Independence Day Parade",
      date: "August 17, 2023",
      participants: 80,
      image: "🏍️"
    },
    {
      title: "Cross-Java Adventure",
      date: "July 15-22, 2023",
      participants: 35,
      image: "🗺️"
    },
    {
      title: "Safety Campaign",
      date: "June 10, 2023",
      participants: 120,
      image: "🛡️"
    }
  ];

  return (
    <section id="events" className="py-20 bg-background">
      <div className="container mx-auto px-4">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="section-title mb-6">EVENTS & ACTIVITIES</h2>
          <p className="text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
            Join us in our regular rides, charity events, and community activities. 
            Every event strengthens our brotherhood and creates lasting memories.
          </p>
        </div>

        {/* Upcoming Events */}
        <div className="mb-16">
          <h3 className="text-3xl font-bold text-foreground mb-8 aggressive-border">
            Upcoming Events
          </h3>
          <div className="grid lg:grid-cols-3 gap-6">
            {upcomingEvents.map((event) => (
              <Card key={event.id} className="biker-card group hover:scale-105 transition-all duration-300">
                <CardContent className="p-6">
                  {/* Event Status Badge */}
                  <div className="flex justify-between items-start mb-4">
                    <Badge 
                      variant={event.status === 'featured' ? 'default' : 'secondary'}
                      className={event.status === 'featured' ? 'bg-primary text-primary-foreground' : ''}
                    >
                      {event.status === 'featured' ? 'Featured' : 'Open'}
                    </Badge>
                    <Calendar className="w-5 h-5 text-primary" />
                  </div>

                  {/* Event Title */}
                  <h4 className="text-xl font-bold text-foreground mb-3 group-hover:text-primary transition-colors">
                    {event.title}
                  </h4>

                  {/* Event Details */}
                  <div className="space-y-3 mb-4">
                    <div className="flex items-center text-muted-foreground">
                      <Calendar className="w-4 h-4 mr-2 text-primary" />
                      <span className="text-sm">{event.date}</span>
                    </div>
                    <div className="flex items-center text-muted-foreground">
                      <Clock className="w-4 h-4 mr-2 text-primary" />
                      <span className="text-sm">{event.time}</span>
                    </div>
                    <div className="flex items-center text-muted-foreground">
                      <MapPin className="w-4 h-4 mr-2 text-primary" />
                      <span className="text-sm">{event.location}</span>
                    </div>
                    <div className="flex items-center text-muted-foreground">
                      <Users className="w-4 h-4 mr-2 text-primary" />
                      <span className="text-sm">{event.participants} registered</span>
                    </div>
                  </div>

                  {/* Description */}
                  <p className="text-sm text-muted-foreground mb-6">
                    {event.description}
                  </p>

                  {/* Register Button */}
                  <Button className="w-full hero-button group">
                    Register Now
                    <ArrowRight className="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" />
                  </Button>
                </CardContent>
              </Card>
            ))}
          </div>
        </div>

        {/* Past Events */}
        <div>
          <h3 className="text-3xl font-bold text-foreground mb-8 aggressive-border">
            Recent Activities
          </h3>
          <div className="grid md:grid-cols-3 gap-6">
            {pastEvents.map((event, index) => (
              <Card key={index} className="biker-card group hover:scale-105 transition-all duration-300">
                <CardContent className="p-6 text-center">
                  <div className="text-4xl mb-4">{event.image}</div>
                  <h4 className="text-lg font-bold text-foreground mb-2 group-hover:text-primary transition-colors">
                    {event.title}
                  </h4>
                  <p className="text-sm text-muted-foreground mb-2">{event.date}</p>
                  <div className="flex items-center justify-center text-primary">
                    <Users className="w-4 h-4 mr-1" />
                    <span className="text-sm font-medium">{event.participants} participants</span>
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>
        </div>

        {/* CTA Section */}
        <div className="text-center mt-16">
          <Card className="biker-card max-w-2xl mx-auto">
            <CardContent className="p-8">
              <h3 className="text-2xl font-bold text-foreground mb-4">Never Miss an Event</h3>
              <p className="text-muted-foreground mb-6">
                Join our WhatsApp group to get instant notifications about upcoming rides and events.
              </p>
              <Button size="lg" className="hero-button">
                Join WhatsApp Group
                <ArrowRight className="ml-2 w-5 h-5" />
              </Button>
            </CardContent>
          </Card>
        </div>
      </div>
    </section>
  );
};

export default EventsSection;