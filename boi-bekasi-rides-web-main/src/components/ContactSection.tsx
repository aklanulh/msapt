import { MapPin, Phone, Mail, Instagram, Youtube, Facebook, Send } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';

const ContactSection = () => {
  return (
    <section id="contact" className="py-20 bg-muted/30">
      <div className="container mx-auto px-4">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="section-title mb-6">GET IN TOUCH</h2>
          <p className="text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
            Ready to join the brotherhood? Have questions about our events? 
            Reach out to us and become part of the BOI Bekasi family.
          </p>
        </div>

        <div className="grid lg:grid-cols-2 gap-12">
          {/* Contact Info */}
          <div className="space-y-8">
            <div className="aggressive-border">
              <h3 className="text-2xl font-bold text-foreground mb-6">Basecamp Location</h3>
              
              {/* Contact Details */}
              <div className="space-y-4 mb-8">
                <div className="flex items-start space-x-4">
                  <MapPin className="w-6 h-6 text-primary mt-1 flex-shrink-0" />
                  <div>
                    <p className="font-medium text-foreground">BOI Bekasi Basecamp</p>
                    <p className="text-muted-foreground">
                      Jl. Cut Meutia No. 123<br />
                      Bekasi Timur, Bekasi 17113<br />
                      Jawa Barat, Indonesia
                    </p>
                  </div>
                </div>

                <div className="flex items-center space-x-4">
                  <Phone className="w-6 h-6 text-primary flex-shrink-0" />
                  <div>
                    <p className="font-medium text-foreground">Phone</p>
                    <p className="text-muted-foreground">+62 812-3456-7890</p>
                  </div>
                </div>

                <div className="flex items-center space-x-4">
                  <Mail className="w-6 h-6 text-primary flex-shrink-0" />
                  <div>
                    <p className="font-medium text-foreground">Email</p>
                    <p className="text-muted-foreground">info@boibekasi.com</p>
                  </div>
                </div>
              </div>

              {/* Social Media */}
              <div>
                <h4 className="text-lg font-bold text-foreground mb-4">Follow Us</h4>
                <div className="flex space-x-4">
                  <Button variant="outline" size="icon" className="hover:bg-primary hover:text-primary-foreground transition-colors">
                    <Instagram className="w-5 h-5" />
                  </Button>
                  <Button variant="outline" size="icon" className="hover:bg-primary hover:text-primary-foreground transition-colors">
                    <Youtube className="w-5 h-5" />
                  </Button>
                  <Button variant="outline" size="icon" className="hover:bg-primary hover:text-primary-foreground transition-colors">
                    <Facebook className="w-5 h-5" />
                  </Button>
                </div>
              </div>
            </div>

            {/* Map Placeholder */}
            <Card className="biker-card">
              <CardContent className="p-0">
                <div className="h-64 bg-muted rounded-lg flex items-center justify-center">
                  <div className="text-center">
                    <MapPin className="w-12 h-12 text-primary mx-auto mb-4" />
                    <p className="text-foreground font-medium">Interactive Map</p>
                    <p className="text-sm text-muted-foreground">Basecamp Location in Bekasi</p>
                  </div>
                </div>
              </CardContent>
            </Card>
          </div>

          {/* Contact Form */}
          <Card className="biker-card">
            <CardContent className="p-8">
              <h3 className="text-2xl font-bold text-foreground mb-6">Send us a Message</h3>
              
              <form className="space-y-6">
                <div className="grid md:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-sm font-medium text-foreground mb-2">
                      First Name
                    </label>
                    <Input 
                      placeholder="Your first name"
                      className="bg-background border-border focus:border-primary"
                    />
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-foreground mb-2">
                      Last Name
                    </label>
                    <Input 
                      placeholder="Your last name"
                      className="bg-background border-border focus:border-primary"
                    />
                  </div>
                </div>

                <div>
                  <label className="block text-sm font-medium text-foreground mb-2">
                    Email
                  </label>
                  <Input 
                    type="email"
                    placeholder="your.email@example.com"
                    className="bg-background border-border focus:border-primary"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-foreground mb-2">
                    Phone Number
                  </label>
                  <Input 
                    type="tel"
                    placeholder="+62 xxx-xxxx-xxxx"
                    className="bg-background border-border focus:border-primary"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-foreground mb-2">
                    Message
                  </label>
                  <Textarea 
                    placeholder="Tell us about yourself and why you want to join BOI Bekasi..."
                    rows={5}
                    className="bg-background border-border focus:border-primary resize-none"
                  />
                </div>

                <Button type="submit" className="w-full hero-button">
                  Send Message
                  <Send className="ml-2 w-4 h-4" />
                </Button>
              </form>
            </CardContent>
          </Card>
        </div>

        {/* Quick Actions */}
        <div className="grid md:grid-cols-3 gap-6 mt-16">
          <Card className="biker-card group hover:scale-105 transition-all duration-300">
            <CardContent className="p-6 text-center">
              <div className="w-16 h-16 bg-gradient-accent rounded-full mx-auto mb-4 flex items-center justify-center">
                <Phone className="w-8 h-8 text-primary-foreground" />
              </div>
              <h4 className="text-lg font-bold text-foreground mb-2">Quick Call</h4>
              <p className="text-sm text-muted-foreground mb-4">
                Need immediate assistance? Call us directly.
              </p>
              <Button variant="outline" className="w-full">Call Now</Button>
            </CardContent>
          </Card>

          <Card className="biker-card group hover:scale-105 transition-all duration-300">
            <CardContent className="p-6 text-center">
              <div className="w-16 h-16 bg-gradient-accent rounded-full mx-auto mb-4 flex items-center justify-center">
                <Instagram className="w-8 h-8 text-primary-foreground" />
              </div>
              <h4 className="text-lg font-bold text-foreground mb-2">Follow Instagram</h4>
              <p className="text-sm text-muted-foreground mb-4">
                See our latest rides and events.
              </p>
              <Button variant="outline" className="w-full">Follow Us</Button>
            </CardContent>
          </Card>

          <Card className="biker-card group hover:scale-105 transition-all duration-300">
            <CardContent className="p-6 text-center">
              <div className="w-16 h-16 bg-gradient-accent rounded-full mx-auto mb-4 flex items-center justify-center">
                <Send className="w-8 h-8 text-primary-foreground" />
              </div>
              <h4 className="text-lg font-bold text-foreground mb-2">WhatsApp Group</h4>
              <p className="text-sm text-muted-foreground mb-4">
                Join our active community chat.
              </p>
              <Button variant="outline" className="w-full">Join Group</Button>
            </CardContent>
          </Card>
        </div>
      </div>
    </section>
  );
};

export default ContactSection;