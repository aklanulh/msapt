import { Shield, Target, Users, Award } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';

const AboutSection = () => {
  return (
    <section id="about" className="py-20 bg-muted/30">
      <div className="container mx-auto px-4">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="section-title mb-6">ABOUT BOI BEKASI</h2>
          <p className="text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
            Born from the passion for Benelli motorcycles and forged by brotherhood, 
            BOI Bekasi stands as the premier motorcycle community in Bekasi and surrounding areas.
          </p>
        </div>

        {/* Main Content Grid */}
        <div className="grid lg:grid-cols-2 gap-12 items-center mb-16">
          {/* History & Story */}
          <div className="space-y-6">
            <div className="aggressive-border">
              <h3 className="text-2xl font-bold text-foreground mb-4">Our Story</h3>
              <p className="text-muted-foreground leading-relaxed mb-4">
                Established in 2020, Benelli Owner Indonesia Chapter Bekasi was founded by a group of 
                passionate riders who shared more than just a love for motorcycles – we shared a vision 
                of brotherhood, respect, and adventure.
              </p>
              <p className="text-muted-foreground leading-relaxed">
                What started as casual weekend rides has evolved into a strong community of over 150 
                active members, organizing events, charity rides, and fostering the spirit of 
                camaraderie that defines the Benelli family.
              </p>
            </div>

            <div className="aggressive-border">
              <h3 className="text-2xl font-bold text-foreground mb-4">Our Values</h3>
              <ul className="space-y-2 text-muted-foreground">
                <li className="flex items-center">
                  <div className="w-2 h-2 bg-primary rounded-full mr-3" />
                  Brotherhood above all else
                </li>
                <li className="flex items-center">
                  <div className="w-2 h-2 bg-primary rounded-full mr-3" />
                  Safety and responsible riding
                </li>
                <li className="flex items-center">
                  <div className="w-2 h-2 bg-primary rounded-full mr-3" />
                  Community service and charity
                </li>
                <li className="flex items-center">
                  <div className="w-2 h-2 bg-primary rounded-full mr-3" />
                  Respect for all riders
                </li>
              </ul>
            </div>
          </div>

          {/* Vision & Mission Cards */}
          <div className="space-y-6">
            <Card className="biker-card">
              <CardContent className="p-8">
                <div className="flex items-center mb-4">
                  <Target className="w-8 h-8 text-primary mr-3" />
                  <h3 className="text-xl font-bold text-foreground">Our Vision</h3>
                </div>
                <p className="text-muted-foreground leading-relaxed">
                  To be the most respected and united Benelli motorcycle community in Indonesia, 
                  setting the standard for brotherhood, safety, and community engagement.
                </p>
              </CardContent>
            </Card>

            <Card className="biker-card">
              <CardContent className="p-8">
                <div className="flex items-center mb-4">
                  <Shield className="w-8 h-8 text-primary mr-3" />
                  <h3 className="text-xl font-bold text-foreground">Our Mission</h3>
                </div>
                <p className="text-muted-foreground leading-relaxed">
                  To create lasting bonds among Benelli riders, promote safe riding practices, 
                  organize meaningful events, and contribute positively to our local community.
                </p>
              </CardContent>
            </Card>
          </div>
        </div>

        {/* Leadership Section */}
        <div className="text-center">
          <h3 className="text-3xl font-bold text-foreground mb-8">Leadership Team</h3>
          <div className="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            {/* President */}
            <Card className="biker-card">
              <CardContent className="p-6 text-center">
                <div className="w-20 h-20 bg-gradient-accent rounded-full mx-auto mb-4 flex items-center justify-center">
                  <Users className="w-10 h-10 text-primary-foreground" />
                </div>
                <h4 className="text-lg font-bold text-foreground mb-2">President</h4>
                <p className="text-primary font-medium mb-2">Ahmad Rizki</p>
                <p className="text-sm text-muted-foreground">
                  Leading with passion and commitment to our brotherhood
                </p>
              </CardContent>
            </Card>

            {/* Vice President */}
            <Card className="biker-card">
              <CardContent className="p-6 text-center">
                <div className="w-20 h-20 bg-gradient-accent rounded-full mx-auto mb-4 flex items-center justify-center">
                  <Shield className="w-10 h-10 text-primary-foreground" />
                </div>
                <h4 className="text-lg font-bold text-foreground mb-2">Vice President</h4>
                <p className="text-primary font-medium mb-2">Budi Santoso</p>
                <p className="text-sm text-muted-foreground">
                  Ensuring safety and coordination in all our activities
                </p>
              </CardContent>
            </Card>

            {/* Secretary */}
            <Card className="biker-card">
              <CardContent className="p-6 text-center">
                <div className="w-20 h-20 bg-gradient-accent rounded-full mx-auto mb-4 flex items-center justify-center">
                  <Award className="w-10 h-10 text-primary-foreground" />
                </div>
                <h4 className="text-lg font-bold text-foreground mb-2">Secretary</h4>
                <p className="text-primary font-medium mb-2">Diana Putri</p>
                <p className="text-sm text-muted-foreground">
                  Managing communications and member relations
                </p>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </section>
  );
};

export default AboutSection;